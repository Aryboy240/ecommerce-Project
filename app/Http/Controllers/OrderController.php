<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Display all orders (can be filtered by customer later)
    public function index()
    {
        $orders = Order::with(['customer', 'items'])->get();
        return view('orders.index', compact('orders'));
    }

    // Show single order details
    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);
        return view('orders.show', compact('order'));
    }

    // Create new order
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            // Calculate total amount and check stock
            $totalAmount = 0;
            foreach ($validatedData['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }
                $totalAmount += $product->price * $item['quantity'];
            }

            // Create order
            $order = Order::create([
                'customer_id' => $validatedData['customer_id'],
                'total_amount' => $totalAmount,
                'status' => 'pending'
            ]);

            // Create order items and update stock
            foreach ($validatedData['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);

                // Update product stock
                $product->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('orders.show', $order)->with('success', 'Order created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,shipped,delivered'
        ]);

        $order->update([
            'status' => $validatedData['status']
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order status updated successfully');
    }

    // Get customer's order history
    public function customerOrders($customerId)
    {
        $orders = Order::with(['items.product'])
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.customer-orders', compact('orders'));
    }

    // Test method for creating orders
    public function testCreate()
    {
        try {
            // Get first customer and products from our test data
            $customer = \App\Models\Customer::first();
            
            if (!$customer) {
                return "Error: No customer found in database";
            }

            // Get first two products
            $products = Product::take(2)->get();
            
            if ($products->isEmpty()) {
                return "Error: No products found in database";
            }

            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'total_amount' => 0,
                'status' => 'pending'
            ]);

            $totalAmount = 0;

            // Add products to order
            foreach ($products as $product) {
                $quantity = 1;
                $totalAmount += $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                // Update stock
                $product->decrement('stock_quantity', $quantity);
            }

            // Update order total
            $order->update(['total_amount' => $totalAmount]);

            DB::commit();

            // Return detailed response for testing
            return [
                'message' => 'Order created successfully!',
                'order_id' => $order->id,
                'customer' => $customer->first_name . ' ' . $customer->last_name,
                'total_amount' => $totalAmount,
                'items' => $order->items->map(function($item) {
                    return [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price
                    ];
                })
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}