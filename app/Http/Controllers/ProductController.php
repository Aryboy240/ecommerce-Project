<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session; // Added for flashing session alerts

class ProductController extends Controller
{
    /* 
        This controller:
        1. Fetches data from the database
        2. Passes this data to the views for rendering
        3. Handles user inputs (search queries and filtering)
    */

    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        }

        // Category filtering (Fixed "All Categories" issue)
        if ($request->has('category') && $request->category !== 'all' && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        // Retrieve products with pagination
        $products = $query->with('category', 'images')->paginate(5);

        // Fetch all available categories from the database
        $categories = ProductCategory::all();

        // Calculate stock tracking data
        $totalFramesInStock = Product::sum('stock_quantity');
        $lowStockFrames = Product::where('stock_quantity', '<', 10)->count();
        $outOfStockFrames = Product::where('stock_quantity', '=', 0)->count();
        $newThisMonth = Product::whereMonth('created_at', now()->month)->count();

        return view('admin.AdminProduct', compact(
            'products', 
            'categories', 
            'totalFramesInStock', 
            'lowStockFrames', 
            'outOfStockFrames', 
            'newThisMonth'
        ));
    }

    public function show($id)
    {
        $product = Product::with([
            'images',
            'category',
            'reviews.user'
        ])->findOrFail($id);

        return view('sproduct', compact('product'));
    }

    public function featuredProducts()
    {
        $products = Product::whereIn('id', [
            32859928, 33137483, 32861686, 33087542, 32677959, 33137346, 32860634, 33039633
        ])->with('category', 'images')->get();

        return view('welcome', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->stock_quantity = $request->stock_quantity;
        $product->save();

        // Store the alert in the session
        if ($product->stock_quantity == 0) {
            Session::flash('out_of_stock_alert', "⚠️ {$product->name} is now out of stock!");
        } elseif ($product->stock_quantity <= config('constants.low_stock_threshold')) {
            Session::flash('low_stock_alert', "⚠️ {$product->name} is low on stock!");
        }

        return redirect()->route('productadmin')->with('success', 'Stock updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('productadmin')->with('success', 'Product deleted successfully.');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Save Product
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->category_id = $request->category_id;
        $product->save();

        // Save Product Image
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');

            $product->images()->create([
                'image_path' => $imagePath
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Product added successfully']);
    }

    public function getProductsByFaceShape(Request $request)
    {
        $shape = $request->input('shape');
        
        // Define a mapping of face shapes to product IDs
        $faceShapeProducts = [
            'Round' => [32859935, 32859928, 33039947],
            'Square' => [33137490, 33135175, 33155449],
            'Oval' => [33087542, 32860634, 33137346],
            'Heart' => [33039633, 33145006, 33137353],
            'Diamond' => [33039640, 33040011, 33145013],
            'Triangular' => [32677959, 32859942, 32908640],
        ];
        
        // Get the product IDs for the selected shape
        $productIds = $faceShapeProducts[$shape] ?? [];

        // Fetch the products from the database
        $products = Product::whereIn('id', $productIds)
            ->with('category', 'images.imageType')
            ->get();

        // Format products with an image URL for JavaScript
        $formattedProducts = $products->map(function ($product) {
            $frontImage = $product->images->firstWhere('imageType.name', 'front');
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'category' => $product->category->name ?? 'Unknown',
                'image_url' => $frontImage ? asset($frontImage->image_path) : asset('images/default.png'),
            ];
        });

        return response()->json($formattedProducts);
    }
}









