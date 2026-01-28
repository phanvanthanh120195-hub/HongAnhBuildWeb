<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class ReviewController extends Controller
{
    #[OA\Get(
        path: '/api/reviews',
        operationId: 'getReviewsList',
        tags: ['Reviews'],
        summary: 'Lấy danh sách đánh giá',
        description: 'Trả về danh sách tất cả các đánh giá đang hoạt động',
        parameters: [
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 10)),
            new OA\Parameter(name: 'course_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                type: 'object',
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'reviewer_name', type: 'string', example: 'Nguyễn Văn A'),
                                    new OA\Property(property: 'rating', type: 'integer', example: 5),
                                    new OA\Property(property: 'content', type: 'string'),
                                    new OA\Property(property: 'avatar', type: 'string'),
                                ]
                            )
                        ),
                    ]
                )
            )
        ]
    )]
    public function index(Request $request)
    {
        $query = Review::where('is_active', true)
            ->with(['user', 'course'])
            ->orderBy('created_at', 'desc');

        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $limit = $request->get('limit', 10);
        $reviews = $query->limit($limit)->get();

        // Transform data for frontend
        $data = $reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'name' => $review->reviewer_name ?? ($review->user ? $review->user->name : 'Anonymous'),
                'avatar' => $review->user && $review->user->avatar
                    ? asset('storage/' . $review->user->avatar)
                    : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&h=100&fit=crop',
                'rating' => $review->rating,
                'comment' => $review->content,
                'course' => $review->course ? $review->course->name : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
