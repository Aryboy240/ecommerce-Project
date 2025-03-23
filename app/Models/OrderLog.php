<?php
/**
 * Handles order history logging for tracking all order activities
 * 
 * This model is responsible for maintaining a comprehensive log of all actions
 * performed on orders including status changes, refunds, and administrative actions.
 * 
 * Modified by: Vatsal
 * Student code: 220408633
 * Added comprehensive order history tracking system
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'action',
        'details'
    ];

    /**
     * Get the order that owns the log.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user that created the log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get human-readable action name.
     */
    public function getActionNameAttribute()
    {
        $actions = [
            'order_created' => 'Order Created',
            'status_changed' => 'Status Changed',
            'order_cancelled' => 'Order Cancelled',
            'refund_requested' => 'Refund Requested',
            'refund_approved' => 'Refund Approved',
            'refund_completed' => 'Refund Completed',
            'refund_rejected' => 'Refund Rejected',
            'admin_note_added' => 'Admin Note Added',
            'stock_returned' => 'Stock Returned',
            'payment_received' => 'Payment Received',
            'shipment_created' => 'Shipment Created',
            'delivery_confirmed' => 'Delivery Confirmed'
        ];
        
        return $actions[$this->action] ?? ucfirst(str_replace('_', ' ', $this->action));
    }

    /**
     * Format created_at date for display.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i:s');
    }
}