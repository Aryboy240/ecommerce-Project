<?php

//<--
//    Developer: Vatsal Mehta
//    University ID: 220408633
//    Function: Event for tracking order status changes
//-->

namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged
{
    use Dispatchable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * The old status.
     *
     * @var string
     */
    public $oldStatus;

    /**
     * The new status.
     *
     * @var string
     */
    public $newStatus;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Order  $order
     * @param  string  $oldStatus
     * @param  string  $newStatus
     * @return void
     */
    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}