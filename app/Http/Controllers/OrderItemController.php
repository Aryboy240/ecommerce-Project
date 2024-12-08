<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($validatedData['product_id']);

            // Check stock
            if ($product->stock_quantity < $validatedData['quantity']) {
                throw new \Exception("Insufficient stock for product: {$product->name}");
            }

            // Create order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'price' => $product->price
            ]);

            // Update product stock
            $product->decrement('stock_quantity', $validatedData['quantity']);

            // Update order total
            $order->increment('total_amount', $product->price * $validatedData['quantity']);

            DB::commit();
            return redirect()->route('orders.show', $order)
                           ->with('success', 'Item added to order successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Order $order, OrderItem $item)
    {
        try {
            DB::beginTransaction();

            // Restore product stock
            $item->product->increment('stock_quantity', $item->quantity);

            // Update order total
            $order->decrement('total_amount', $item->price * $item->quantity);

            // Delete the item
            $item->delete();

            DB::commit();
            return redirect()->route('orders.show', $order)
                           ->with('success', 'Item removed from order successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}