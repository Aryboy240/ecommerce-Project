<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Handles all order-related operations for the e-commerce website
 * 
 * This controller manages the creation, display, and management of orders
 * placed by authenticated users through the website's shopping interface.
 */
class OrderController extends Controller
{
    /**
     * Constructor to ensure all order operations require authentication
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            ->get();
            
        return view('orders.index', compact('orders'));
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
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['items.product']);
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
            
            // Get cart items and create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_amount' => 0 // Will be calculated from items
            ]);

            // Add logic here to transfer cart items to order
            // This will be implemented when cart functionality is ready

            DB::commit();
            return redirect()->route('orders.show', $order)
                           ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }
}