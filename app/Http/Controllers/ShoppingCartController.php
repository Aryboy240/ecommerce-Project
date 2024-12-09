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
    
            // Validate the request
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
    
            // Find the cart item and its associated product
            $cartItem = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->findOrFail($request->cart_item_id);
    
            $quantityDifference = $request->quantity - $cartItem->quantity;
    
            // Check if enough stock is available for the requested quantity increase
            if ($quantityDifference > 0 && $cartItem->product->stock_quantity < $quantityDifference) {
                return response()->json([
                    'error' => 'Not enough stock available'
                ], 422);
            }
    
            // Update stock
            $cartItem->product->increment('stock_quantity', -$quantityDifference);
            $cartItem->update(['quantity' => $request->quantity]);
    
            // Calculate the new total for this item
            $itemTotal = $cartItem->product->price * $cartItem->quantity;
    
            // Recalculate the overall cart total
            $total = ShoppingCartItem::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
    
            DB::commit();
    
            // Return the updated totals
            return response()->json([
                'message' => 'Cart updated successfully',
                'total_price' => $itemTotal,
                'subtotal' => $total,
                'cart_total' => $total // Assuming you might add shipping, adjust accordingly
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

            // Validate cart_item_id in request
            $validator = Validator::make($request->all(), [
                'cart_item_id' => 'required|exists:shopping_cart_items,id'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            DB::beginTransaction();

            // Fetch the item in the cart
            $cartItem = ShoppingCartItem::where('user_id', Auth::id())
                ->findOrFail($request->cart_item_id);

            // Return quantity to the product's stock
            $cartItem->product->increment('stock_quantity', $cartItem->quantity);
            $cartItem->delete();

            // Recalculate the cart total
            $total = ShoppingCartItem::where('user_id', Auth::id())
                ->get()
                ->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

            DB::commit();

            return response()->json([
                'message' => 'Item removed from cart',
                'total' => number_format($total, 2)
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