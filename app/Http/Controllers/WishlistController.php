<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller  

{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product.images') 
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingWishlistItem) {
            return response()->json(['success' => false, 'message' => 'Product is already in your wishlist!']);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to wishlist successfully!']);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

         Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->delete();

            return response()->json([ 'success' => true, 'message' => 'Product removed from wishlist successfully!',
            ]);
        }
 }