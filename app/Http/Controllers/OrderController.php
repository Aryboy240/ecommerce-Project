<?php
/**
 * Handles all order-related operations for the e-commerce website
 * 
 * This controller manages the creation, display, and management of orders
 * placed by authenticated users through the website's shopping interface.
 * 
 * Modified by: Vatsal
 * Student code: 220408633
 * Added admin reporting functionality and order status management
 * Updated to ensure all statistics always reflect actual database values
 * Enhanced order history tracking for improved auditing
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\OrderLog;
use App\Events\OrderStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Constructor to ensure all order operations require authentication
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['adminReport', 'updateOrderStatus']);
    }

    /**
     * Display all orders for the authenticated user
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the checkout form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('orders.create', compact('cartItems', 'total'));
    }

    /**
     * Display details of a specific order
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        // Ensure users can only view their own orders
        if ($order->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        $order->load(['items.product', 'logs']);
        return view('orders.show', compact('order'));
    }

    /**
     * Create a new order from the user's cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Get cart items
            $cartItems = DB::table('shopping_cart_items')
                ->where('user_id', Auth::id())
                ->get();
                
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Your cart is empty');
            }
            
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => Order::STATUS_PENDING,
                'total_amount' => 0, // Will be calculated from items
                'payment_method' => $request->input('payment_method', 'online')
            ]);
            
            $totalAmount = 0;
            
            // Transfer cart items to order
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);
                
                // Check if product is in stock
                if ($product->stock_quantity < $cartItem->quantity) {
                    DB::rollBack();
                    return back()->with('error', "Insufficient stock for {$product->name}");
                }
                
                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price
                ]);
                
                // Update product stock
                $product->decreaseStock($cartItem->quantity);
                
                // Calculate total
                $totalAmount += $product->price * $cartItem->quantity;
            }
            
            // Update order total
            $order->update(['total_amount' => $totalAmount]);
            
            // Create order log
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'action' => 'order_created',
                'details' => "Order created with " . $cartItems->count() . " items for £" . number_format($totalAmount, 2)
            ]);
            
            // Clear cart
            DB::table('shopping_cart_items')
                ->where('user_id', Auth::id())
                ->delete();

            DB::commit();
            return redirect()->route('orders.show', $order)
                           ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
    
    /**
     * Update the status of an order (for admin use)
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        // Ensure user is admin
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        
        $validatedData = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses()))
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $validatedData['status'];
        
        // Only update if status has changed
        if ($oldStatus !== $newStatus) {
            $order->status = $newStatus;
            $order->save();
            
            // Trigger the status changed event
            event(new OrderStatusChanged($order, $oldStatus, $newStatus));
            
            return back()->with('success', 'Order status updated successfully');
        }
        
        return back()->with('info', 'Order status remains unchanged');
    }
    
    /**
     * Process a refund request for an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function refund(Request $request, Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized access');
        }

        // Check if the order can be refunded
        if (!$order->canBeRefunded()) {
            return back()->with('error', 'This order cannot be refunded');
        }

        DB::beginTransaction();

        try {
            // Update order status
            $oldStatus = $order->status;
            $order->status = Order::STATUS_REFUND_REQUESTED;
            $order->notes = $request->input('refund_reason', 'Customer requested refund');
            $order->save();
            
            // Log the refund request
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'action' => 'refund_requested',
                'details' => $request->input('refund_reason', 'No reason provided')
            ]);
            
            // Trigger status changed event
            event(new OrderStatusChanged($order, $oldStatus, Order::STATUS_REFUND_REQUESTED));

            DB::commit();

            return back()->with('success', 'Refund request submitted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Refund request failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    /**
     * Complete a refund for an order (admin only)
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeRefund(Request $request, Order $order)
    {
        // Check if user is admin
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        
        // Check if order is in refund_requested status
        if ($order->status !== Order::STATUS_REFUND_REQUESTED) {
            return back()->with('error', 'This order is not awaiting refund');
        }
        
        DB::beginTransaction();
        
        try {
            $oldStatus = $order->status;
            $order->status = Order::STATUS_REFUNDED;
            $order->refund_transaction_id = $request->input('refund_transaction_id');
            $order->save();
            
            // Log the refund completion
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'action' => 'refund_completed',
                'details' => 'Refund processed by admin' . 
                    ($request->input('refund_transaction_id') ? ' (Transaction: ' . $request->input('refund_transaction_id') . ')' : '')
            ]);
            
            // Trigger the status changed event
            event(new OrderStatusChanged($order, $oldStatus, Order::STATUS_REFUNDED));
            
            DB::commit();
            return back()->with('success', 'Refund processed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Refund completion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to process refund: ' . $e->getMessage());
        }
    }
    
    /**
     * Admin dashboard report view
     *
     * @return \Illuminate\View\View
     */
    public function adminReport()
    {
        // Ensure user is admin
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
        
        // Calculate total revenue from completed orders - exact real value only
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_amount');
            
        // Calculate revenue growth (last 30 days vs previous 30 days)
        $lastMonth = Order::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->sum('total_amount');
            
        $previousMonth = Order::where('status', 'completed')
            ->whereBetween('created_at', [Carbon::now()->subDays(60), Carbon::now()->subDays(30)])
            ->sum('total_amount');
            
        $revenueGrowth = $previousMonth > 0 
            ? round(($lastMonth - $previousMonth) / $previousMonth * 100) 
            : 0;
        
        // Get new orders count (last 30 days) - exact real value only
        $newOrdersCount = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
            
        // Calculate order growth
        $previousOrdersCount = Order::whereBetween('created_at', [Carbon::now()->subDays(60), Carbon::now()->subDays(30)])
            ->count();
            
        $orderGrowth = $previousOrdersCount > 0 
            ? round(($newOrdersCount - $previousOrdersCount) / $previousOrdersCount * 100) 
            : 0;
        
        // Get new customers (last 30 days) - exact real value only
        $newCustomersCount = User::where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('is_admin', false)
            ->count();
            
        // Calculate customer growth
        $previousCustomersCount = User::whereBetween('created_at', [Carbon::now()->subDays(60), Carbon::now()->subDays(30)])
            ->where('is_admin', false)
            ->count();
            
        $customerGrowth = $previousCustomersCount > 0 
            ? round(($newCustomersCount - $previousCustomersCount) / $previousCustomersCount * 100) 
            : 0;
        
        // Get total product count - exact real value only
        $productCount = Product::count();
        $totalProducts = $productCount; // For clarity in the view
        
        // Get top 3 bestselling products
        $topProducts = Product::with('images') 
        ->select('products.id', 'products.name', 'products.price', 
            DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold'))
        ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
        ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
        ->where(function($query) {
            $query->where('orders.status', 'completed')
                ->orWhereNull('orders.status');
        })
        ->groupBy('products.id', 'products.name', 'products.price')
        ->orderByDesc('total_sold')
        ->limit(3)
        ->get();

            
        // Calculate sales percentage for each top product
        $totalSold = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->sum('order_items.quantity');
            
        foreach ($topProducts as $product) {
            $product->sales_percentage = $totalSold > 0 
                ? round(($product->total_sold / $totalSold) * 100) 
                : 0;
        }
        
        // Get products with their incoming and outgoing orders
        $products = Product::with(['images', 'category'])->get();
        
        foreach ($products as $product) {
            // Get incoming orders count (pending)
            $product->incoming_count = OrderItem::whereHas('order', function($query) {
                $query->whereIn('status', ['pending', 'processing']);
            })->where('product_id', $product->id)->sum('quantity');
            
            // Get outgoing orders count (completed)
            $product->outgoing_count = OrderItem::whereHas('order', function($query) {
                $query->whereIn('status', ['shipped', 'delivered', 'completed']);
            })->where('product_id', $product->id)->sum('quantity');
            
            // Get recent orders for this product
            $product->recent_orders = OrderItem::select(
                'order_items.*',
                'orders.status',
                'orders.created_at',
                DB::raw("CASE WHEN orders.status IN ('pending', 'processing') THEN 'in' ELSE 'out' END as type")
            )
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('product_id', $product->id)
            ->orderByDesc('orders.created_at')
            ->limit(2)
            ->get();
        }
        
        // Get out of stock products
        $outOfStockProducts = Product::where('stock_quantity', '<=', 0)->get();
        
        // Get incoming orders (pending)
        $incomingOrders = OrderItem::with(['product.images', 'order'])
            ->whereHas('order', function($query) {
                $query->whereIn('status', ['pending', 'processing']);
            })
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
            
        // Get outgoing orders (shipped, delivered, completed)
        $outgoingOrders = OrderItem::with(['product.images', 'order'])
            ->whereHas('order', function($query) {
                $query->whereIn('status', ['shipped', 'delivered', 'completed']);
            })
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        
        // Generate data for orders per month chart - use actual order data
        $ordersByMonth = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('count', 'month')
            ->toArray();
            
        $orderChartLabels = [];
        $orderChartData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $orderChartLabels[] = date('M', mktime(0, 0, 0, $i, 1));
            $orderChartData[] = $ordersByMonth[$i] ?? 0; // Default to 0 for months with no orders
        }
        
        // Generate data for customers over time chart - use actual user data
        $customersByMonth = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('is_admin', false)
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('count', 'month')
            ->toArray();
        
        $customerChartLabels = [];
        $customerChartData = [];
        $cumulativeCustomers = 0;
        
        for ($i = 1; $i <= 12; $i++) {
            $customerChartLabels[] = date('M', mktime(0, 0, 0, $i, 1));
            $cumulativeCustomers += $customersByMonth[$i] ?? 0;
            $customerChartData[] = $cumulativeCustomers;
        }
        
        return view('admin.AdminReport', compact(
            'totalRevenue',
            'revenueGrowth',
            'newOrdersCount',
            'orderGrowth',
            'newCustomersCount',
            'customerGrowth',
            'productCount',
            'totalProducts',
            'topProducts',
            'products',
            'outOfStockProducts',
            'incomingOrders',
            'outgoingOrders',
            'orderChartLabels',
            'orderChartData',
            'customerChartLabels',
            'customerChartData'
        ));
    }
    
    /**
     * Admin orders view with improved filtering and sorting
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function adminOrders(Request $request)
    {
        // Ensure user is admin
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
        
        $query = Order::with(['user', 'items.product']);
        
        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->where('created_at', '>=', Carbon::parse($request->date_from)->startOfDay());
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }
        
        // Filter by customer if provided
        if ($request->has('customer') && $request->customer) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%')
                  ->orWhere('email', 'like', '%' . $request->customer . '%');
            });
        }
        
        // Sort orders if sorting parameters are provided
        if ($request->has('sort') && $request->has('direction')) {
            $allowedSortFields = ['id', 'created_at', 'status', 'total_amount'];
            $sortField = in_array($request->sort, $allowedSortFields) ? $request->sort : 'created_at';
            $sortDirection = in_array(strtolower($request->direction), ['asc', 'desc']) ? $request->direction : 'desc';
            
            $query->orderBy($sortField, $sortDirection);
        } else {
            // Default sorting by latest
            $query->latest();
        }
        
        $orders = $query->paginate(15)->withQueryString();
        
        // Get available statuses for the filter dropdown
        $statuses = Order::getStatuses();
        
        return view('admin.AdminOrders', compact('orders', 'statuses'));
    }
    
    /**
     * Admin order details view with complete history
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function adminOrderDetail(Order $order)
    {
        // Ensure user is admin
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
        
        $order->load(['user', 'items.product', 'logs.user']);
        
        // Get available statuses for the status update dropdown
        $statuses = Order::getStatuses();
        
        return view('admin.AdminOrderDetail', compact('order', 'statuses'));
    }
    
    /**
     * Add admin note to an order
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNote(Request $request, Order $order)
    {
        // Ensure user is admin
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403);
        }
        
        $validatedData = $request->validate([
            'note' => 'required|string|max:1000'
        ]);
        
        // Update order notes
        if ($order->notes) {
            $order->notes .= "\n\n" . now()->format('d M Y H:i') . " - " . $validatedData['note'];
        } else {
            $order->notes = now()->format('d M Y H:i') . " - " . $validatedData['note'];
        }
        
        $order->save();
        
        // Log the note addition
        OrderLog::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'action' => 'admin_note_added',
            'details' => $validatedData['note']
        ]);
        
        return back()->with('success', 'Note added successfully');
    }
}