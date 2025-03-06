<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    /* 
        All this function does is:
        
        1.  Fetch data from the database
        2.  Pass this data to the views for rendering
        3.  Handle user inputs (search query)
    */

    /* We also need to add filters, but I'm sure you could do that without me */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        }

        // Category filtering
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }

        // Price filtering
        if ($request->has('min_price') && $request->min_price !== null) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price !== null) {
            $query->where('price', '<=', $request->max_price);
        }

        // Retrieve products with their related images, image types, and category
        $products = $query->with(['images.imageType', 'category'])->get();

        // $products = $query->with(['images.imageType', 'category'])->paginate(10);
        // This is for when the size of total products gets large - 10 per page

        // Return the view with the products
        return view('search', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['images.imageType', 'category'])->findOrFail($id);

        return view('sproduct', compact('product'));
    }


}
