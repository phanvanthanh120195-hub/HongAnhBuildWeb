<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeaturedReview;
use Illuminate\Http\Request;

class FeaturedReviewController extends Controller
{
    public function index()
    {
        $reviews = FeaturedReview::with(['productReview.customer', 'productReview.product', 'courseReview.customer', 'courseReview.course'])
            ->where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($review) {
                // Get the original review object
                $originalReview = $review->review;
                
                if (!$originalReview) {
                    return null;
                }

                // Determine context name (Product name or Course title)
                $contextName = '';
                if ($review->source_type === 'product') {
                    $contextName = $originalReview->product->name ?? '';
                    $contextSubtext = 'Khách hàng mua sản phẩm';
                } else {
                    $contextName = $originalReview->course->title ?? '';
                    $contextSubtext = 'Học viên khóa học';
                }

                return [
                    'id' => $review->id,
                    'display_name' => $review->display_name ?: ($originalReview->customer->name ?? 'Người dùng ẩn danh'),
                    'display_avatar' => $review->display_avatar ? url('storage/' . $review->display_avatar) : null,
                    'display_label' => $review->display_label ?: $contextSubtext, // Fallback to contextSubtext if no label provided
                    'content' => $originalReview->content,
                    'rating' => $originalReview->rating,
                    'source_type' => $review->source_type,
                    'context_name' => $contextName,
                    'context_subtext' => $contextSubtext,
                    'display_order' => $review->display_order,
                ];
            })
            ->filter(); // Remove nulls if any original review is missing

        return response()->json([
            'status' => 'success',
            'data' => $reviews->values(),
        ]);
    }
}
