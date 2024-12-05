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

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(ShoppingCartItem::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}