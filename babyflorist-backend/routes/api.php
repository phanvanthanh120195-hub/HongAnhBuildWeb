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
Route::get('/courses/flash-deal', [App\Http\Controllers\Api\CourseController::class, 'flashDeal']);
Route::get('/courses', [App\Http\Controllers\Api\CourseController::class, 'index']);
Route::get('/courses/{slug}', [App\Http\Controllers\Api\CourseController::class, 'show']);

Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Blog Posts
Route::get('/blogs', [App\Http\Controllers\Api\BlogPostController::class, 'index']);
Route::get('/blogs/{slug}', [App\Http\Controllers\Api\BlogPostController::class, 'show']);

// Reviews
Route::get('/reviews', [App\Http\Controllers\Api\ReviewController::class, 'index']);

// Customer Authentication
Route::prefix('customer')->group(function () {
    Route::post('/register', [App\Http\Controllers\Api\CustomerAuthController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\Api\CustomerAuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [App\Http\Controllers\Api\CustomerAuthController::class, 'logout']);
        Route::get('/profile', [App\Http\Controllers\Api\CustomerAuthController::class, 'profile']);
        Route::post('/profile', [App\Http\Controllers\Api\CustomerAuthController::class, 'updateProfile']);
        Route::post('/change-password', [App\Http\Controllers\Api\CustomerAuthController::class, 'changePassword']);
    });
});

// Bank Information
Route::get('/banks', [App\Http\Controllers\Api\BankController::class, 'index']);

// Voucher Check
Route::post('/vouchers/check', [App\Http\Controllers\Api\VoucherController::class, 'check']);

// Order Methods
Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'store']);
Route::post('/orders/{id}/confirm', [App\Http\Controllers\Api\OrderController::class, 'confirm']);
