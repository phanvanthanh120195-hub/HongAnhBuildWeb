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
        Schema::create('featured_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('source_type'); // 'product' or 'course'
            $table->unsignedBigInteger('source_id');
            $table->string('display_name')->nullable();
            $table->string('display_avatar')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Index for faster lookups based on source type and id
            $table->index(['source_type', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_reviews');
    }
};
