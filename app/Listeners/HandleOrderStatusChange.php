<?php
/**
 * Listener to handle order status changes
 * 
 * This listener is responsible for processing events when orders change status,
 * including recording the change in the order logs and triggering any necessary actions.
 * 
 * Modified by: Vatsal
 * Student code: 220408633
 * Added comprehensive status change handling and logging
 */

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Models\OrderLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HandleOrderStatusChange implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChanged $event): void
    {
        // Log the status change
        OrderLog::create([
            'order_id' => $event->order->id,
            'user_id' => Auth::id() ?? $event->order->user_id,
            'action' => 'status_changed',
            'details' => json_encode([
                'old_status' => $event->oldStatus,
                'new_status' => $event->newStatus,
                'changed_by' => Auth::id() ?? 'system',
                'timestamp' => now()->toDateTimeString()
            ])
        ]);

        // Perform actions based on the new status
        switch ($event->newStatus) {
            case 'shipped':
                // Could send shipping notification email here
                break;
                
            case 'delivered':
                // Could send delivery confirmation email here
                break;
                
            case 'refunded':
                // Update product stock if needed
                foreach ($event->order->items as $item) {
                    $item->product->increment('stock_quantity', $item->quantity);
                    
                    // Log stock return
                    OrderLog::create([
                        'order_id' => $event->order->id,
                        'user_id' => Auth::id() ?? $event->order->user_id,
                        'action' => 'stock_returned',
                        'details' => "Returned {$item->quantity} units of product #{$item->product_id} to inventory"
                    ]);
                }
                break;
        }
    }
}