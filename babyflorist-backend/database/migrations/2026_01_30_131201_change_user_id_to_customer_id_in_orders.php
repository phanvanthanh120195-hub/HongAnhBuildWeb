<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop old FK
        try {
            DB::statement('ALTER TABLE `orders` DROP FOREIGN KEY `orders_user_id_foreign`');
        } catch (\Exception $e) {}

        // Rename column
        if (Schema::hasColumn('orders', 'user_id')) {
            DB::statement('ALTER TABLE `orders` CHANGE `user_id` `customer_id` BIGINT UNSIGNED NULL');
        }

        // Add new FK
        try {
            DB::statement('ALTER TABLE `orders` ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE SET NULL');
        } catch (\Exception $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement('ALTER TABLE `orders` DROP FOREIGN KEY `orders_customer_id_foreign`');
        } catch (\Exception $e) {}

        if (Schema::hasColumn('orders', 'customer_id')) {
            DB::statement('ALTER TABLE `orders` CHANGE `customer_id` `user_id` BIGINT UNSIGNED NULL');
        }

        try {
            DB::statement('ALTER TABLE `orders` ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL');
        } catch (\Exception $e) {}
    }
};
