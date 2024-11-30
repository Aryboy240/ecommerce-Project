<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCartItem;
use App\Models\Product;
use App\Models\Customer;
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

            // Check if product has enough stock
            $product = Product::findOrFail($validated['product_id']);
            if ($product->stock_quantity < $validated['quantity']) {
                return ['error' => 'Not enough stock available'];
            }

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
            $cartItems = ShoppingCartItem::with(['product', 'customer'])
                                       ->where('customer_id', $customerId)
                                       ->get();

            $total = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            return [
                'items' => $cartItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'subtotal' => $item->product->price * $item->quantity
                    ];
                }),
                'total' => $total,
                'item_count' => $cartItems->sum('quantity')
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

            $product = Product::findOrFail($validated['product_id']);
            if ($product->stock_quantity < $validated['quantity']) {
                return ['error' => 'Not enough stock available'];
            }

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

    public function testCart()
    {
        try {
            // Get first customer and product
            $customer = Customer::first();
            $product = Product::first();

            if (!$customer || !$product) {
                return "Error: No customer or product found in database";
            }

            // Clear existing cart first
            $this->clearCart($customer->id);

            // Test adding to cart
            $addResult = $this->addToCart(new Request([
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'quantity' => 2
            ]));

            // Get cart contents
            $cartContents = $this->getCart($customer->id);

            // Update quantity
            $updateResult = $this->updateQuantity(new Request([
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'quantity' => 3
            ]));

            // Final cart contents
            $finalCart = $this->getCart($customer->id);

            return [
                'test_customer' => [
                    'id' => $customer->id,
                    'name' => $customer->first_name . ' ' . $customer->last_name
                ],
                'test_product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price
                ],
                'add_result' => $addResult,
                'initial_cart' => $cartContents,
                'update_result' => $updateResult,
                'final_cart' => $finalCart
            ];

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}