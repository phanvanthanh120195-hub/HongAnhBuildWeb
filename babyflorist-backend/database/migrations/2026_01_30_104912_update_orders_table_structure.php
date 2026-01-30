<?php

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
            $table->enum('order_type', ['product', 'course'])->default('product')->after('order_number');
            $table->decimal('subtotal_amount', 12, 2)->nullable()->after('user_id');
            $table->decimal('shipping_fee', 12, 2)->default(0)->after('discount_amount');
            
            // Modify existing enums using DB:statement for MySQL compatibility
            // Laravel's change() method for enums is tricky, often better to use raw SQL for modifying enum options if package doctrine/dbal is not perfect or for simple enum additions.
            // However, since we are adding columns, let's do that first.
            
            $table->dateTime('paid_at')->nullable()->after('payment_status');
            $table->dateTime('expired_at')->nullable()->after('paid_at');
            $table->foreignId('bank_id')->nullable()->after('payment_method'); // Assuming we will link this to qr_codes later or it's just bigInt
            $table->string('payment_reference', 50)->nullable()->after('bank_id');
            $table->enum('shipping_status', ['pending', 'shipping', 'delivered', 'returned'])->nullable()->after('order_status');
            $table->enum('shipping_method', ['standard', 'express', 'pickup'])->nullable()->after('shipping_status');
        });

        // Update ENUMs using raw SQL because Laravel schema builder doesn't support changing ENUM values easily
        \DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed', 'refunded') NOT NULL DEFAULT 'pending'");
        \DB::statement("ALTER TABLE orders MODIFY COLUMN order_status ENUM('pending', 'confirmed', 'cancelled', 'completed') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_type', 
                'subtotal_amount', 
                'shipping_fee', 
                'paid_at', 
                'expired_at', 
                'bank_id', 
                'payment_reference', 
                'shipping_status', 
                'shipping_method'
            ]);
        });

        // Revert ENUMs to original state
        // Original payment_status: ['pending', 'paid', 'failed']
        // Original order_status: ['pending', 'paid', 'preparing', 'shipping', 'completed', 'cancelled']
        \DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending'");
        \DB::statement("ALTER TABLE orders MODIFY COLUMN order_status ENUM('pending', 'paid', 'preparing', 'shipping', 'completed', 'cancelled') NOT NULL DEFAULT 'pending'");
    }
};
