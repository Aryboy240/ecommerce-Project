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
}