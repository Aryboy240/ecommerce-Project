<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_type_id', // Add this to allow mass assignment
        'image_path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function imageType()
    {
        return $this->belongsTo(ImageType::class, 'image_type_id');
    }
}
