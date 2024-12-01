<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Create test customer
        $customer = Customer::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password_hash' => bcrypt('password123'),
            'is_active' => true
        ]);

        // Create product categories
        $electronicsCategory = ProductCategory::create([
            'name' => 'Electronics',
            'description' => 'Electronic devices and accessories'
        ]);

        $clothingCategory = ProductCategory::create([
            'name' => 'Clothing',
            'description' => 'Fashion items and accessories'
        ]);

        // Create products
        $products = [
            Product::create([
                'name' => 'Laptop',
                'description' => 'High-performance laptop',
                'category_id' => $electronicsCategory->id,
                'price' => 999.99,
                'stock_quantity' => 10
            ]),
            Product::create([
                'name' => 'Smartphone',
                'description' => 'Latest smartphone model',
                'category_id' => $electronicsCategory->id,
                'price' => 599.99,
                'stock_quantity' => 15
            ]),
            Product::create([
                'name' => 'T-Shirt',
                'description' => 'Cotton T-Shirt',
                'category_id' => $clothingCategory->id,
                'price' => 19.99,
                'stock_quantity' => 50
            ]),
            Product::create([
                'name' => 'Jeans',
                'description' => 'Blue Denim Jeans',
                'category_id' => $clothingCategory->id,
                'price' => 49.99,
                'stock_quantity' => 30
            ])
        ];

        // Create a test order with items
        $order = Order::create([
            'customer_id' => $customer->id,
            'status' => 'pending',
            'total_amount' => 1599.98 // Laptop + Smartphone
        ]);

        // Add items to order
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[0]->id, // Laptop
            'quantity' => 1,
            'price' => 999.99
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[1]->id, // Smartphone
            'quantity' => 1,
            'price' => 599.99
        ]);
    }
}