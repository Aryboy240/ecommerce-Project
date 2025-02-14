<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'stock_quantity'
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relationship with Reviews
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    // Relationship with Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with Cart Items
    public function cartItems()
    {
        return $this->hasMany(ShoppingCartItem::class);
    }

    // Relationship with Images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}