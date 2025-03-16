<?php
//<--
//    Developer: Vatsal Mehta
//    University ID: 220408633
//    Function: Order service class handling order creation and processing
//-->

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\OrderAddress;
use App\Models\OrderStatusHistory;
use App\Models\OrderLog;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * Create a new order from the user's cart
     *
     * @param int $userId
     * @param array $shippingData
     * @param string $paymentMethod
     * @param string $paymentTransactionId
     * @return Order
     * @throws \Exception
     */
    public function createOrderFromCart($userId, array $shippingData, $paymentMethod, $paymentTransactionId = null)
    {
        return DB::transaction(function () use ($userId, $shippingData, $paymentMethod, $paymentTransactionId) {
            // Get cart items
            $cartItems = DB::table('shopping_cart_items')
                ->where('user_id', $userId)
                ->get();
                
            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }
            
            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING,
                'total_amount' => 0,
                'payment_method' => $paymentMethod,
                'payment_transaction_id' => $paymentTransactionId
            ]);
            
            // Create shipping address
            $order->addresses()->create([
                'type' => 'shipping',
                'first_name' => $shippingData['fname'],
                'last_name' => $shippingData['lname'],
                'email' => $shippingData['email'],
                'phone' => $shippingData['phone'],
                'address_line1' => $shippingData['shipping_address'],
                'city' => $shippingData['city'],
                'postal_code' => $shippingData['postcode'],
                'country' => 'United Kingdom'
            ]);
            
            $totalAmount = 0;
            $stockIssues = [];
            
            // Check stock for all products first
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);
                
                if ($product->stock_quantity < $cartItem->quantity) {
                    $stockIssues[] = "Insufficient stock for {$product->name} (Requested: {$cartItem->quantity}, Available: {$product->stock_quantity})";
                }
            }
            
            // If there are stock issues, throw an exception
            if (!empty($stockIssues)) {
                throw new \Exception('Stock issues: ' . implode(', ', $stockIssues));
            }
            
            // Transfer cart items to order
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);
                
                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price
                ]);
                
                // Update product stock
                $product->decreaseStock($cartItem->quantity);
                
                // Calculate total
                $totalAmount += $product->price * $cartItem->quantity;
            }
            
            // Update order total
            $order->update(['total_amount' => $totalAmount]);
            
            // Log the order creation
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'action' => 'order_created',
                'details' => "Order created with {$cartItems->count()} items"
            ]);
            
            // Clear cart
            DB::table('shopping_cart_items')
                ->where('user_id', $userId)
                ->delete();
                
            // Fire order created event
            event(new OrderCreated($order));
                
            return $order;
        }, 5); // Set a higher number of retries for this critical operation
    }
    
    /**
     * Process order refund
     *
     * @param Order $order
     * @param int $userId
     * @param string|null $reason
     * @return Order
     * @throws \Exception
     */
    public function processRefund(Order $order, $userId, $reason = null)
    {
        return DB::transaction(function () use ($order, $userId, $reason) {
            // Check if order can be refunded
            if (!$order->canBeRefunded()) {
                throw new \Exception('This order cannot be refunded');
            }
            
            // Update order status
            $order->updateStatus(Order::STATUS_REFUND_REQUESTED, $userId, $reason);
            
            // Log refund request
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'action' => 'refund_requested',
                'details' => $reason ?? 'No reason provided'
            ]);
            
            // Additional logic for processing the refund could go here
            // For example, integration with payment gateway
            
            return $order;
        });
    }
    
    /**
     * Complete an order refund
     *
     * @param Order $order
     * @param int $userId
     * @param string|null $refundTransactionId
     * @return Order
     * @throws \Exception
     */
    public function completeRefund(Order $order, $userId, $refundTransactionId = null)
    {
        return DB::transaction(function () use ($order, $userId, $refundTransactionId) {
            // Only refund requested orders can be completed
            if ($order->status !== Order::STATUS_REFUND_REQUESTED) {
                throw new \Exception('Only refund-requested orders can be refunded');
            }
            
            // Update order status
            $order->updateStatus(Order::STATUS_REFUNDED, $userId, 'Refund completed');
            
            // Store refund transaction ID if provided
            if ($refundTransactionId) {
                $order->update([
                    'refund_transaction_id' => $refundTransactionId
                ]);
            }
            
            // Return inventory to stock if appropriate
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
                
                // Log stock return
                OrderLog::create([
                    'order_id' => $order->id,
                    'user_id' => $userId,
                    'action' => 'stock_returned',
                    'details' => "Returned {$item->quantity} units of product #{$item->product_id} to inventory"
                ]);
            }
            
            // Log refund completion
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'action' => 'refund_completed',
                'details' => $refundTransactionId ? "Refund transaction ID: {$refundTransactionId}" : 'No transaction ID provided'
            ]);
            
            return $order;
        });
    }
    
    /**
     * Cancel an order
     *
     * @param Order $order
     * @param int $userId
     * @param string|null $reason
     * @return Order
     * @throws \Exception
     */
    public function cancelOrder(Order $order, $userId, $reason = null)
    {
        return DB::transaction(function () use ($order, $userId, $reason) {
            // Check if order can be cancelled based on status
            if (!in_array($order->status, [Order::STATUS_PENDING, Order::STATUS_PROCESSING])) {
                throw new \Exception('This order cannot be cancelled');
            }
            
            // Update order status
            $order->updateStatus(Order::STATUS_CANCELLED, $userId, $reason);
            
            // Return inventory to stock
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
            
            // Log cancellation
            OrderLog::create([
                'order_id' => $order->id,
                'user_id' => $userId,
                'action' => 'order_cancelled',
                'details' => $reason ?? 'No reason provided'
            ]);
            
            return $order;
        });
    }
    
    /**
     * Get orders with detailed information for a specific user
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserOrders($userId, $limit = 10)
    {
        return Order::with(['items.product.images', 'addresses'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    
    /**
     * Get detailed information for a specific order
     *
     * @param int $orderId
     * @param int $userId
     * @return Order
     * @throws \Exception
     */
    public function getOrderDetails($orderId, $userId = null)
    {
        $query = Order::with([
            'items.product.images', 
            'addresses', 
            'statusHistory.user',
            'user'
        ]);
        
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        $order = $query->findOrFail($orderId);
        
        return $order;
    }
}