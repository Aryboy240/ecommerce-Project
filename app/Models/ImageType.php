<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    public function productImages() // Renamed from products() to productImages()
    {
        return $this->hasMany(ProductImage::class, 'image_type_id');
    }
}
