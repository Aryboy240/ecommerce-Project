<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ImageType;
use Illuminate\Support\Facades\Session; // For flashing session alerts
use Illuminate\Support\Facades\Storage; // For file storage handling
use Illuminate\Support\Facades\Log; // For logging debug information

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

    // Made by Aryan Kora 👍
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Retrieve the category name
        $category = ProductCategory::findOrFail($request->category_id);
    
        // Save Product details
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->category_id = $request->category_id;
        $product->save();
    
        // Handle image upload
        if ($request->hasFile('product_image')) {
            $imageFile = $request->file('product_image');
            \Log::info('File uploaded:', ['file' => $imageFile]);
    
            // Ensure the product ID exists or eerything will break
            $productId = $product->id;
    
            // The image type is just set to 'front' cos I'm lazy (only shows thumbnail for product)
            $imageType = 'front';
            $fileExtension = $imageFile->getClientOriginalExtension();
            $fileName = "{$productId}-{$imageType}-2000x1125.{$fileExtension}";
    
            // Stores the storage path in a varaible because I cba to keep copying and pasting
            $storagePath = storage_path("app/public/Images/products/Featured/{$category->name}/{$productId}/");
    
            // Ensure the directory exists, create if not
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0777, true); // Makes the new directory with max perms hopefully
                \Log::info('Created directory:', ['path' => $storagePath]);
            }
    
            // Move and copy the file to the specified directory
            $imageFilePath = $imageFile->getRealPath();
            $destinationPath = $storagePath . $fileName;
    
            // Copy the file to the new location with the new name
            if (copy($imageFilePath, $destinationPath)) {
                \Log::info('File successfully copied:', ['destination' => $destinationPath]);
            } else {
                \Log::error('File copy failed:', ['destination' => $destinationPath]);
            }

            /* LOGS LOGS LOGS LOGS LOGS NOTHING IS WORKING AAAA */
            /* Never mind, after checking the logs it was saving it to a new folder location  (app/sotrage, not public/Images) */
            /* So changing the image path below to that location makes the image show up, yippeeee */
    
            // Save the image path in the database
            $imagePath = "storage/Images/products/Featured/{$category->name}/{$productId}/{$fileName}";
            $product->images()->create([
                'image_path' => $imagePath,
                'image_type_id' => ImageType::where('name', 'front')->first()->id
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









