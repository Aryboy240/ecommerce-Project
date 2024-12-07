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

        // Retrieve products with their related images and image types
        $products = $query->with(['images.imageType'])->get();

        // Return the view with the products
        return view('products.searchHTML', compact('products'));
    }
}
