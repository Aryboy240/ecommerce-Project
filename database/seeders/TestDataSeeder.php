<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Create test user with proper fields
        $user = User::create([
            'name' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'birthday' => '2000-01-01'
        ]);

        // Create relevant product categories
        $sunglassesCategory = ProductCategory::create([
            'name' => 'Sunglasses',
            'description' => 'Stylish UV protection eyewear'
        ]);

        $prescriptionCategory = ProductCategory::create([
            'name' => 'Prescription Glasses',
            'description' => 'Prescription eyewear for daily use'
        ]);

        $accessoriesCategory = ProductCategory::create([
            'name' => 'Accessories',
            'description' => 'Eyewear accessories and care products'
        ]);

        // Create relevant products
        $products = [
            Product::create([
                'name' => 'Classic Aviator Sunglasses',
                'description' => 'Timeless aviator style with UV400 protection',
                'category_id' => $sunglassesCategory->id,
                'price' => 89.99,
                'stock_quantity' => 50
            ]),
            Product::create([
                'name' => 'Round Metal Frame Glasses',
                'description' => 'Vintage-inspired round prescription frames',
                'category_id' => $prescriptionCategory->id,
                'price' => 129.99,
                'stock_quantity' => 30
            ]),
            Product::create([
                'name' => 'Premium Lens Cleaning Kit',
                'description' => 'Complete kit for proper eyewear maintenance',
                'category_id' => $accessoriesCategory->id,
                'price' => 19.99,
                'stock_quantity' => 100
            ]),
            Product::create([
                'name' => 'Wayfarer Style Sunglasses',
                'description' => 'Classic wayfarer design with polarized lenses',
                'category_id' => $sunglassesCategory->id,
                'price' => 99.99,
                'stock_quantity' => 40
            ])
        ];

        // Create a test order
        $order = Order::create([
            'user_id' => $user->id, 
            'status' => 'pending',
            'total_amount' => 209.98 // Aviator + Cleaning Kit
        ]);

        // Add items to order
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[0]->id, // Aviator Sunglasses
            'quantity' => 2,
            'price' => 89.99
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[2]->id, // Cleaning Kit
            'quantity' => 1,
            'price' => 19.99
        ]);
    }
}