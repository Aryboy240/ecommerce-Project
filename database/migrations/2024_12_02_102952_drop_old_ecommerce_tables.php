<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOldEcommerceTables extends Migration
{
    public function up()
    {
        // Drop in reverse order of dependencies
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('shopping_cart_items');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('admin_users');
    }

    public function down()
    {
        
    }
}