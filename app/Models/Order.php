<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_amount'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    /**
     * Get all products associated with this order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    
    /**
     * Calculate the total amount for this order.
     */
    public function calculateTotal()
    {
        $total = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        $this->total_amount = $total;
        $this->save();
        
        return $total;
    }
    
    /**
     * Check if order can be refunded.
     */
    public function canBeRefunded()
    {
        return in_array($this->status, ['shipped', 'delivered', 'pending']);
    }
}