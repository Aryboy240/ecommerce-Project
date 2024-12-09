<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Validation rules for cart items.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ];

    /**
     * Get the user that owns the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product of the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the subtotal for this cart item.
     *
     * @return float
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    /**
     * Check if the requested quantity is available in stock.
     *
     * @param int $quantity
     * @return bool
     */
    public function hasEnoughStock($quantity)
    {
        return $this->product->stock_quantity >= $quantity;
    }

    /**
     * Increment the quantity of the cart item.
     *
     * @param int $amount
     * @return bool
     */
    public function incrementQuantity($amount = 1)
    {
        if ($this->hasEnoughStock($this->quantity + $amount)) {
            $this->quantity += $amount;
            return $this->save();
        }
        return false;
    }

    /**
     * Decrement the quantity of the cart item.
     *
     * @param int $amount
     * @return bool
     */
    public function decrementQuantity($amount = 1)
    {
        if ($this->quantity - $amount > 0) {
            $this->quantity -= $amount;
            return $this->save();
        } else {
            return $this->delete();
        }
    }

    /**
     * Scope a query to only include cart items of a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Create or update a cart item.
     *
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @return ShoppingCartItem
     */
    public static function updateOrCreateItem($userId, $productId, $quantity)
    {
        return static::updateOrCreate(
            [
                'user_id' => $userId,
                'product_id' => $productId
            ],
            [
                'quantity' => \DB::raw("COALESCE(quantity, 0) + $quantity")
            ]
        );
    }
}