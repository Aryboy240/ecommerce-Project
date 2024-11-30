<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            // Check if product is already in cart
            $cartItem = ShoppingCartItem::where('customer_id', $validated['customer_id'])
                                      ->where('product_id', $validated['product_id'])
                                      ->first();

            if ($cartItem) {
                // Update quantity if item exists
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $validated['quantity']
                ]);
            } else {
                // Create new cart item
                $cartItem = ShoppingCartItem::create([
                    'customer_id' => $validated['customer_id'],
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity']
                ]);
            }

            return [
                'message' => 'Item added to cart',
                'cart_item' => $cartItem
            ];

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'product_id' => 'required|exists:products,id'
            ]);

            ShoppingCartItem::where('customer_id', $validated['customer_id'])
                          ->where('product_id', $validated['product_id'])
                          ->delete();

            return ['message' => 'Item removed from cart'];

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getCart($customerId)
    {
        try {
            $cartItems = ShoppingCartItem::with('product')
                                       ->where('customer_id', $customerId)
                                       ->get();

            $total = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            return [
                'items' => $cartItems,
                'total' => $total
            ];

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function clearCart($customerId)
    {
        try {
            ShoppingCartItem::where('customer_id', $customerId)->delete();
            return ['message' => 'Cart cleared'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateQuantity(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $cartItem = ShoppingCartItem::where('customer_id', $validated['customer_id'])
                                      ->where('product_id', $validated['product_id'])
                                      ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $validated['quantity']]);
                return ['message' => 'Quantity updated', 'cart_item' => $cartItem];
            }

            return ['error' => 'Item not found in cart'];

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}