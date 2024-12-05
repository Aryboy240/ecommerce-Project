<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ImageType;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        ImageType::firstOrCreate(['name' => 'front']);
        ImageType::firstOrCreate(['name' => 'side']);
        ImageType::firstOrCreate(['name' => 'model']);

        // Create test user with proper fields
        $user = User::create([
            'name' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'birthday' => '2000-01-01'
        ]);

        // Define products by category
        $productsByCategory = [
            'Adidas' => [
                32859928,
                32859935,
                32859942,
            ],
            'Disney' => [
                33087542,
                33137131,
                33137148,
            ],
            'Comfit' => [
                32861686,
                33145006,
                33145013,
            ],
        ];

        // Loop through each category and its product IDs
        foreach ($productsByCategory as $categoryName => $productIds) {
            // Get the category instance by name (or create it if not found)
            $category = ProductCategory::where('name', $categoryName)->first();
            if (!$category) {
                $category = ProductCategory::create(['name' => $categoryName]);
            }

            // Loop through each product ID for this category
            foreach ($productIds as $productId) {
                // Ensure the product exists
                $product = Product::find($productId);
                if (!$product) {
                    // Optionally, create the product if it doesn't exist (remove this if you expect the product to be already created)
                    $product = Product::create([
                        'id' => $productId,
                        'name' => "Product {$productId}",
                        'description' => "Description for product {$productId}",
                        'category_id' => $category->id,
                        'price' => 100,  // Example price
                        'stock_quantity' => 10  // Example stock
                    ]);
                }

                // Get all image types (front, side, model, etc.)
                $imageTypes = ImageType::all();

                // Loop through each image type and create a product image
                foreach ($imageTypes as $type) {
                    ProductImage::create([
                        'product_id' => $product->id,  // Link the image to the product
                        'image_type_id' => $type->id,  // Link the image to the type
                        'image_path' => $this->generateImagePath($category, $product, $type),  // Generate the image path dynamically
                    ]);
                }
            }
        }
    }
    
    /**
     * Generate the image path for a product based on its category, ID, and image type.
     *
     * @param  \App\Models\ProductCategory  $category
     * @param  \App\Models\Product   $product
     * @param  \App\Models\ImageType $type
     * @return string
     */
    protected function generateImagePath(ProductCategory $category, Product $product, ImageType $type)
    {
        return "Images/products/Featured/{$category->name}/{$product->id}/{$product->id}-{$type->name}-2000x1125.jpg";
    }
}
