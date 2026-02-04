<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('reviews') && !Schema::hasTable('course_reviews')) {
            DB::statement('RENAME TABLE `reviews` TO `course_reviews`');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('course_reviews') && !Schema::hasTable('reviews')) {
            DB::statement('RENAME TABLE `course_reviews` TO `reviews`');
        }
    }
};
