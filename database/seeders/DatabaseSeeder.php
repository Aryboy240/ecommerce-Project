<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ImageType;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

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
                32859706,
                32859737,
                32859782,
                32859836,
                32859867,
                32859874,
                32859881,
                32859898,
                32859904,
                32859911,
                32859928,
                32859935,
                32859942
            ],
            'Barbour' =>[
                33136974,
                33136981,
                33136998,
                33137001,
                33137018,
                33137025,
                33137032,
                33137049,
                33137063,
                33137070,
                33137087,
                33137094,
                33137100,
                33137117,
                33137124,
                33137476,
                33137483,
                33137490,
                33137506
            ],
            'Comfit' => [
                30769113,
                30830233,
                32861617,
                32861624,
                32861631,
                32861648,
                32861655,
                32861662,
                32861679,
                32861686,
                33145006,
                33145013
            ],
            'Disney' => [
                30769113,
                30830233,
                32861617,
                32861624,
                32861631,
                32861648,
                32861655,
                32861662,
                32861679,
                32861686,
                33145006,
                33145013
            ],
            'DKNY' =>[
                30825147,
                30825178,
                30825185,
                30825208,
                30825239,
                32677928,
                32677935,
                32677942,
                32677959,
                33039947,
                33040011
            ],
            'Harry Potter' =>[
                32908596,
                32908602,
                32908640,
                33155432,
                33155449
            ],
            'HUGO' =>[
                30826441,
                32261097,
                32261110,
                32915396,
                32915402,
                33135151,
                33137339,
                33137346,
                33137353,
                33137360,
                33471457,
                33471464
            ],
            'Jeff Banks' =>[
                30826441,
                32261097,
                32261110,
                32915396,
                32915402,
                33135151,
                33137339,
                33137346,
                33137353,
                33137360,
                33471457,
                33471464
            ],
            'Karen Millen' =>[
                30826441,
                32261097,
                32261110,
                32915396,
                32915402,
                33135151,
                33137339,
                33137346,
                33137353,
                33137360,
                33471457,
                33471464
            ],
            
        ];

        $faker = Faker::create();

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
                    $product = Product::create([
                        'id' => $productId,
                        'name' => "{$categoryName} - {$productId}",
                        'description' => "Experience timeless elegance this {$categoryName} product. Crafted from premium materials, these versatile frames offer both style and comfort. Features include anti-reflective coating, scratch-resistant lenses, and adjustable nose pads for the perfect fit.",
                        'category_id' => $category->id,
                        // 'price' => 100,  // This sets the price to a default 100
                        // 'price' => rand(50, 500),  // Random price between 50 and 500
                        'price' => $faker->randomFloat(2, 50, 500),  // Random price between 50 and 500 with two decimal places
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
