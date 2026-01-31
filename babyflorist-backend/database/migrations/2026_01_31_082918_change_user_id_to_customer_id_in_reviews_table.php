<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableName = 'reviews';
        $fkName = 'reviews_user_id_foreign';

        // 1. Drop old column (and its FK)
        Schema::table($tableName, function (Blueprint $table) use ($fkName) {
            // Drop FK if exists
            $hasFk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND TABLE_SCHEMA = DATABASE()", ['reviews', $fkName]);
            if (!empty($hasFk)) {
                $table->dropForeign($fkName);
            }
            
            if (Schema::hasColumn('reviews', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });

        // 2. Add new column with FK
        Schema::table($tableName, function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'customer_id')) {
                $table->foreignId('customer_id')->nullable()->after('course_id')->constrained('customers')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->renameColumn('customer_id', 'user_id');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
