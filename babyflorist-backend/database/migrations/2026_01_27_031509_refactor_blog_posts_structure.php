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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['status', 'category', 'tags']);
            $table->boolean('is_active')->default(true)->after('published_at');
            $table->foreignId('blog_category_id')->nullable()->constrained('blog_categories')->nullOnDelete()->after('thumbnail');
        });

        Schema::create('blog_post_blog_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->foreignId('blog_tag_id')->constrained('blog_tags')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_post_blog_tag');

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['blog_category_id']);
            $table->dropColumn(['blog_category_id', 'is_active']);
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
        });
    }
};
