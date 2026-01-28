<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);

// Danh mục sản phẩm
Route::get('/categories', [CategoryController::class, 'index']);
// About Us
Route::get('/about-us', [App\Http\Controllers\Api\AboutUsController::class, 'index']);

// Khóa học
Route::get('/courses', [App\Http\Controllers\Api\CourseController::class, 'index']);

Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Blog Posts
Route::get('/blogs', [App\Http\Controllers\Api\BlogPostController::class, 'index']);
Route::get('/blogs/{slug}', [App\Http\Controllers\Api\BlogPostController::class, 'show']);

// Reviews
Route::get('/reviews', [App\Http\Controllers\Api\ReviewController::class, 'index']);

