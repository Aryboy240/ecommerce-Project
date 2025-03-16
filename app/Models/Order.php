<?php
/**
 * Enhanced Order Model with improved status management and relationships
 * 
 * @author Vatsal Mehta
 * @id 220408633
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Order extends Model
{
    // Define status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_REFUND_REQUESTED = 'refund_requested';
    public const STATUS_REFUNDED = 'refunded';

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'payment_method',
        'payment_transaction_id',
        'refund_transaction_id',
        'notes'
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
     * Get the addresses for the order.
     */
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    /**
     * Get the shipping address for the order.
     */
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

    /**
     * Get the billing address for the order.
     */
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'billing');
    }
    
    /**
     * Get the status history for the order.
     */
    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class)->orderBy('created_at', 'desc');
    }
    
    /**
     * Get the logs for the order.
     */
    public function logs()
    {
        return $this->hasMany(OrderLog::class)->orderBy('created_at', 'desc');
    }
    
    /**
     * Get all available order statuses.
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_REFUND_REQUESTED => 'Refund Requested',
            self::STATUS_REFUNDED => 'Refunded',
        ];
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
     * Update the order status with validation and history tracking.
     *
     * @param string $newStatus
     * @param int|null $userId
     * @param string|null $notes
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function updateStatus($newStatus, $userId = null, $notes = null)
    {
        $allowedTransitions = [
            self::STATUS_PENDING => [
                self::STATUS_PROCESSING, 
                self::STATUS_CANCELLED
            ],
            self::STATUS_PROCESSING => [
                self::STATUS_SHIPPED, 
                self::STATUS_CANCELLED
            ],
            self::STATUS_SHIPPED => [
                self::STATUS_DELIVERED, 
                self::STATUS_CANCELLED
            ],
            self::STATUS_DELIVERED => [
                self::STATUS_COMPLETED, 
                self::STATUS_REFUND_REQUESTED
            ],
            self::STATUS_COMPLETED => [
                self::STATUS_REFUND_REQUESTED
            ],
            self::STATUS_REFUND_REQUESTED => [
                self::STATUS_REFUNDED, 
                self::STATUS_CANCELLED
            ],
        ];

        // Check if transition is allowed
        if (!isset($allowedTransitions[$this->status]) || 
            !in_array($newStatus, $allowedTransitions[$this->status])) {
            throw new \InvalidArgumentException(
                "Invalid status transition from {$this->status} to {$newStatus}"
            );
        }

        $oldStatus = $this->status;
        $this->status = $newStatus;
        $this->save();
        
        // Log the status change for auditing
        OrderStatusHistory::create([
            'order_id' => $this->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $userId,
            'notes' => $notes
        ]);
        
        // Fire event for the status change
        event(new \App\Events\OrderStatusChanged($this, $oldStatus, $newStatus));
        
        return true;
    }
    
    /**
     * Check if order can be refunded.
     */
    public function canBeRefunded()
    {
        return in_array($this->status, [
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
            self::STATUS_COMPLETED,
            self::STATUS_PENDING,
            self::STATUS_PROCESSING
        ]);
    }
}