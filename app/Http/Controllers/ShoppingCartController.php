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

            // Fetch the cart items, including the product and its images
            $items = ShoppingCartItem::with(['product' => function ($query) {
                $query->select('id', 'name', 'price', 'description')
                    ->with('images');  // Eager load images for the product
            }])
            ->where('user_id', Auth::id())
            ->get();

            // Calculate the total price of the items in the cart
            $total = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Get 4 random recommended products
            $recommendedProducts = Product::inRandomOrder()->take(4)->get();

            return view('cart.cart', compact('items', 'total', 'recommendedProducts'));
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
            // Ensure the user is authenticated
            if (!Auth::check()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            // Validate the request
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            DB::beginTransaction();

            // Get the product from the database
            $product = Product::find($request->product_id);
            if (!$product || $product->stock_quantity < $request->quantity) {
                return response()->json(['error' => 'Not enough stock available'], 422);
            }

            // Check if the product already exists in the user's cart
            $cartItem = ShoppingCartItem::where('user_id', Auth::id())
                                        ->where('product_id', $request->product_id)
                                        ->first();

            if ($cartItem) {
                // If the item exists, increment the quantity
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // If the item does not exist, create a new cart item
                $cartItem = new ShoppingCartItem();
                $cartItem->user_id = Auth::id();
                $cartItem->product_id = $request->product_id;
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            }

            DB::commit();

            return response()->json(['success' => 'Product added to cart successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error adding to cart: ' . $e->getMessage()], 500);
        }
    }



    public function showHomePage()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('welcome', compact('products'));
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
                'cart_total' => $total
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

    public function checkout()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect if not authenticated
        }
    
        // Get the user's cart items from the shopping cart
        $cartItems = ShoppingCartItem::where('user_id', Auth::id())
            ->with('product')  // Eager load the product details
            ->get();
    
        // Calculate the total price of the cart
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
    
        // Return the checkout view with the cart items and total
        return view('checkout', compact('cartItems', 'total'));
    }
}