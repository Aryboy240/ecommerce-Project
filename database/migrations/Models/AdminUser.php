<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $fillable = [
        'username',
        'password_hash',
        'role'
    ];

    // We're not using created_at/updated_at timestamps if not needed
    public $timestamps = false;
}