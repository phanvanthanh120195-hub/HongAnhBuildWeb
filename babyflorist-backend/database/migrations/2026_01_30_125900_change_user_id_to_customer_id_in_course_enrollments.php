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
            DB::statement('ALTER TABLE `course_enrollments` DROP FOREIGN KEY `course_enrollments_user_id_foreign`');
        } catch (\Exception $e) {}

        // Rename column
        if (Schema::hasColumn('course_enrollments', 'user_id')) {
            DB::statement('ALTER TABLE `course_enrollments` CHANGE `user_id` `customer_id` BIGINT UNSIGNED NOT NULL');
        }

        // Add new FK
        try {
            DB::statement('ALTER TABLE `course_enrollments` ADD CONSTRAINT `course_enrollments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE');
        } catch (\Exception $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement('ALTER TABLE `course_enrollments` DROP FOREIGN KEY `course_enrollments_customer_id_foreign`');
        } catch (\Exception $e) {}

        if (Schema::hasColumn('course_enrollments', 'customer_id')) {
            DB::statement('ALTER TABLE `course_enrollments` CHANGE `customer_id` `user_id` BIGINT UNSIGNED NOT NULL');
        }

        try {
            DB::statement('ALTER TABLE `course_enrollments` ADD CONSTRAINT `course_enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE');
        } catch (\Exception $e) {}
    }
};
