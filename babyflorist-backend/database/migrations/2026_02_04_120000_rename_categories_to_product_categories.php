<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Drop old foreign key
        try {
            DB::statement('ALTER TABLE `products` DROP FOREIGN KEY `products_category_id_foreign`');
        } catch (\Exception $e) {
            // Ignore if already dropped
        }

        // 2. Rename table
        if (Schema::hasTable('categories') && !Schema::hasTable('product_categories')) {
            DB::statement('RENAME TABLE `categories` TO `product_categories`');
        }

        // 3. Rename column
        if (Schema::hasColumn('products', 'category_id')) {
            DB::statement('ALTER TABLE `products` CHANGE `category_id` `product_category_id` BIGINT UNSIGNED NULL');
        }
        
        // 4. Add new FK
        try {
            DB::statement('ALTER TABLE `products` ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories`(`id`) ON DELETE SET NULL');
        } catch (\Exception $e) {
            // Ignore if already exists
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement('ALTER TABLE `products` DROP FOREIGN KEY `products_product_category_id_foreign`');
        } catch (\Exception $e) {}

        if (Schema::hasColumn('products', 'product_category_id')) {
            DB::statement('ALTER TABLE `products` CHANGE `product_category_id` `category_id` BIGINT UNSIGNED NULL');
        }
        
        if (Schema::hasTable('product_categories') && !Schema::hasTable('categories')) {
            DB::statement('RENAME TABLE `product_categories` TO `categories`');
        }
        
        try {
            DB::statement('ALTER TABLE `products` ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL');
        } catch (\Exception $e) {}
    }
};
