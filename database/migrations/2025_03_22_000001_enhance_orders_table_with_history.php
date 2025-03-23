<?php
/**
 * Migration to enhance orders table and add order_logs table for tracking history
 * 
 * Added by: Vatsal
 * Student code: 220408633
 * Adding order history tracking capabilities
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add missing fields from OrderController.php and OrderService.php
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('total_amount');
            }
            
            if (!Schema::hasColumn('orders', 'payment_transaction_id')) {
                $table->string('payment_transaction_id')->nullable()->after('payment_method');
            }
            
            if (!Schema::hasColumn('orders', 'refund_transaction_id')) {
                $table->string('refund_transaction_id')->nullable()->after('payment_transaction_id');
            }
            
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('refund_transaction_id');
            }
            
            // Modify status enum to include refunded status
            DB::statement("ALTER TABLE orders MODIFY status ENUM('pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled', 'refund_requested', 'refunded') DEFAULT 'pending'");
        });

        // Create order logs table for tracking order history
        if (!Schema::hasTable('order_logs')) {
            Schema::create('order_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('action');
                $table->text('details')->nullable();
                $table->timestamps();
                
                $table->index(['order_id', 'created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_logs');
        
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_transaction_id',
                'refund_transaction_id',
                'notes'
            ]);
            
            DB::statement("ALTER TABLE orders MODIFY status ENUM('pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled', 'refund_requested') DEFAULT 'pending'");
        });
    }
};