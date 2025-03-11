<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\product_categories;

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
    
        // Price filtering (min and max price)
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', $request->min_price);  // Filter by min price
        }
        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', $request->max_price);  // Filter by max price
        }
    
        // Price sorting (if requested)
        if ($request->has('sort_by_price') && $request->sort_by_price !== 'none') {
            $sortOrder = $request->sort_by_price == 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $sortOrder);
        } else {
            // Default to sorting by ID if no price sort is selected
            $query->orderBy('id', 'asc');
        }
    
        // Retrieve products with their related images, image types, and category
        $products = $query->with(['images.imageType', 'category'])->get();
    
        $minPrice = Product::min('price'); // Get the minimum price
        $maxPrice = Product::max('price'); // Get the maximum price
    
        return view('search', compact('products', 'minPrice', 'maxPrice'));
    }
    
    public function show($id)
    {
        $product = Product::with([
            'images.imageType',
            'category',
            'reviews.user' // Load reviews with user data
        ])->findOrFail($id);

        return view('sproduct', compact('product'));
    }

    public function featuredProducts()
    {
        $products = Product::whereIn('id', [
            32859928, 33137483, 32861686, 33087542, 32677959, 33137346, 32860634, 33039633
        ])->with('category', 'images.imageType')->get();

        return view('welcome', compact('products'));
    }
}
