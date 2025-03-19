<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']); 
            $table->decimal('value', 8, 2); 
            $table->decimal('min_cart_amount', 8, 2)->nullable(); 
            $table->dateTime('valid_from'); 
            $table->dateTime('valid_until'); 
            $table->integer('usage_limit')->nullable(); 
            $table->integer('used_count')->default(0); 
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
