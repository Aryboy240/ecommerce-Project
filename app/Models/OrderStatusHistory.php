<?php

//<--
//    Developer: Vatsal Mehta
//    University ID: 220408633
//    Function: Order status history model for tracking status changes
//-->

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'order_id',
       'old_status',
       'new_status',
       'changed_by',
       'notes'
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array
    */
   protected $casts = [
       'order_id' => 'integer',
       'changed_by' => 'integer',
   ];

   /**
    * Get the order that owns the status history.
    */
   public function order()
   {
       return $this->belongsTo(Order::class);
   }

   /**
    * Get the user who changed the status.
    */
   public function user()
   {
       return $this->belongsTo(User::class, 'changed_by');
   }

   /**
    * Get formatted status.
    *
    * @param string $status
    * @return string
    */
   public static function formatStatus($status)
   {
       return ucfirst(str_replace('_', ' ', $status));
   }

   /**
    * Get old status with formatting.
    *
    * @return string
    */
   public function getFormattedOldStatusAttribute()
   {
       return self::formatStatus($this->old_status);
   }

   /**
    * Get new status with formatting.
    *
    * @return string
    */
   public function getFormattedNewStatusAttribute()
   {
       return self::formatStatus($this->new_status);
   }

   /**
    * Get the status change description.
    *
    * @return string
    */
   public function getChangeDescriptionAttribute()
   {
       $userName = $this->user ? $this->user->name : 'System';
       
       return "{$userName} changed order status from {$this->formatted_old_status} to {$this->formatted_new_status}";
   }

   /**
    * Create a new status history entry.
    *
    * @param int $orderId
    * @param string $oldStatus
    * @param string $newStatus
    * @param int|null $userId
    * @param string|null $notes
    * @return OrderStatusHistory
    */
   public static function createEntry($orderId, $oldStatus, $newStatus, $userId = null, $notes = null)
   {
       return self::create([
           'order_id' => $orderId,
           'old_status' => $oldStatus,
           'new_status' => $newStatus,
           'changed_by' => $userId,
           'notes' => $notes
       ]);
   }

   /**
    * Get all status changes for an order.
    *
    * @param int $orderId
    * @return \Illuminate\Database\Eloquent\Collection
    */
   public static function getHistoryForOrder($orderId)
   {
       return self::with('user')
           ->where('order_id', $orderId)
           ->orderBy('created_at', 'desc')
           ->get();
   }
}