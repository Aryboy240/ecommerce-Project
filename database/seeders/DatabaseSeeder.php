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
        ImageType::firstOrCreate(['name' => 'angled']);
        ImageType::firstOrCreate(['name' => 'ortho']);
        ImageType::firstOrCreate(['name' => 'case']);
        ImageType::firstOrCreate(['name' => 'model']);
        ImageType::firstOrCreate(['name' => 'model2']);

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
            'Barbour' =>[
                33137483,
                33137490,
                33137506,
            ],
            'Comfit' => [
                32861686,
                33145006,
                33145013,
            ],
            'Disney' => [
                33087542,
                33137131,
                33137148,
            ],
            'DKNY' =>[
                32677959,
                33039947,
                33040011,
            ],
            'Harry Potter' =>[
                32908640,
                33155432,
                33155449,
            ],
            'HUGO' =>[
                33137346,
                33137353,
                33137360,
            ],
            'Jeff Banks' =>[
                32860634,
                33152820,
                33152882,
            ],
            'Karen Millen' =>[
                33039633,
                33039640,
                33135175
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
                        'name' => "{$categoryName}: Product {$productId}",
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
        // Return the final image path
        return "Images/products/Featured/{$category->name}/{$product->id}/{$product->id}-{$type->name}-2000x1125.jpg";
    }
}
