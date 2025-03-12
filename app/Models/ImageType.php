<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    public function products()
    {
        return $this->hasMany(ProductImage::class);
    }
}
