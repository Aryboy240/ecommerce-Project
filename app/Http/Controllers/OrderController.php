<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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