<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function getCart()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $items = ShoppingCartItem::with(['product' => function($query) {
                $query->select('id', 'name', 'price', 'description');
            }])
            ->where('user_id', Auth::id())
            ->get();

            $total = $items->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            return view('cart.cart', compact('items', 'total'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading cart: ' . $e->getMessage());
        }
    }

    /**
     * Add an item to the shopping cart.
     */
    public function addToCart(Request $request)
    {
        try {
            if (!Auth::check()) {
                session(['url.intended' => url()->previous()]);
                return redirect()->route('login');
            }

            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            // Check product stock
            $product = Product::find($request->product_id);
            if (!$product || $product->stock_quantity < $request->quantity) {
                return redirect()->back()
                    ->with('error', 'Not enough stock available');
            }

            // Update or create cart item
            $cartItem = ShoppingCartItem::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id
                ],
                [
                    'quantity' => DB::raw('COALESCE(quantity, 0) + ' . $request->quantity)
                ]
            );

            // Update product stock
            $product->decrement('stock_quantity', $request->quantity);

            DB::commit();
            
            return redirect()->back()
                ->with('success', 'Product added to cart successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error adding to cart: ' . $e->getMessage());
        }
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateQuantity(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'cart_item_id' => 'required|exists:shopping_cart_items,id',
                'quantity' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }

            DB::beginTransaction();

            $cartItem = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->findOrFail($request->cart_item_id);

            $quantityDifference = $request->quantity - $cartItem->quantity;
            
            // Check if enough stock for quantity increase
            if ($quantityDifference > 0 && $cartItem->product->stock_quantity < $quantityDifference) {
                return response()->json([
                    'error' => 'Not enough stock available'
                ], 422);
            }

            // Update stock
            $cartItem->product->increment('stock_quantity', -$quantityDifference);
            $cartItem->update(['quantity' => $request->quantity]);

            // Calculate new cart total
            $total = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->sum(function($item) {
                    return $item->product->price * $item->quantity;
                });

            DB::commit();

            return response()->json([
                'message' => 'Cart updated successfully',
                'cart_item' => $cartItem,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error updating cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function removeFromCart(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'cart_item_id' => 'required|exists:shopping_cart_items,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }

            DB::beginTransaction();

            $cartItem = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->findOrFail($request->cart_item_id);

            // Return quantity to product stock
            $cartItem->product->increment('stock_quantity', $cartItem->quantity);
            $cartItem->delete();

            // Calculate new cart total
            $total = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->sum(function($item) {
                    return $item->product->price * $item->quantity;
                });

            DB::commit();

            return response()->json([
                'message' => 'Item removed from cart',
                'total' => $total
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error removing item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear the entire cart for the current user.
     */
    public function clearCart()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            DB::beginTransaction();

            // Get all cart items to restore stock
            $cartItems = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();

            // Return quantities to product stock
            foreach ($cartItems as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }

            // Delete all cart items
            ShoppingCartItem::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Cart cleared successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error clearing cart: ' . $e->getMessage());
        }
    }

    /**
     * Get the current cart count for the user.
     */
    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = ShoppingCartItem::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }
}