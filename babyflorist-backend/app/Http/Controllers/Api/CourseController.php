<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class CourseController extends Controller
{
    #[OA\Get(
        path: '/api/courses',
        operationId: 'getCoursesList',
        tags: ['Khóa học'],
        summary: 'Lấy danh sách khóa học',
        description: 'Trả về danh sách tất cả các khóa học đang hoạt động',
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
                                    new OA\Property(property: 'name', type: 'string', example: 'Khóa học cắm hoa cơ bản'),
                                    new OA\Property(property: 'slug', type: 'string', example: 'khoa-hoc-cam-hoa-co-ban'),
                                    new OA\Property(property: 'thumbnail', type: 'string', example: 'courses/thumbnail.jpg'),
                                    new OA\Property(property: 'price', type: 'number', example: 5000000),
                                    new OA\Property(property: 'sale_price', type: 'number', nullable: true, example: 4500000),
                                    new OA\Property(property: 'discount_percent', type: 'integer', nullable: true, example: 10),
                                    new OA\Property(property: 'lesson_count', type: 'integer', example: 12),
                                    new OA\Property(property: 'student_count', type: 'integer', example: 150),
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
        $query = \App\Models\Course::where('is_active', true);

        // Filter by format (optional)
        if ($request->has('format')) {
            $query->where('format', $request->format);
        }

        // Sort by featured first if requested
        if ($request->has('featured_priority')) {
            $query->orderBy('is_featured', 'desc');
        }

        // Default sort
        $query->orderBy('created_at', 'desc');

        // Limit results if requested
        if ($request->has('limit')) {
            $courses = $query->take($request->limit)->get();
        } else {
            $courses = $query->get();
        }

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }
    #[OA\Get(
        path: '/api/courses/flash-deal',
        operationId: 'getFlashDealCourse',
        tags: ['Khóa học'],
        summary: 'Lấy khóa học Flash Deal',
        description: 'Lấy khóa học có giảm giá cao nhất và còn hạn',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function flashDeal()
    {
        $now = now();
        // Priority: Highest Discount % -> Newest
        // REQUIRE sale_end to be set for flash deal
        $deal = \App\Models\Course::where('is_active', true)
            ->whereNotNull('sale_price')
            ->whereNotNull('sale_end') // Must have end date set
            ->where('price', '>', 0)
            ->whereRaw('sale_price < price')
            ->where(function ($query) use ($now) {
                $query->whereNull('sale_start')->orWhere('sale_start', '<=', $now);
            })
            ->where('sale_end', '>=', $now) // Must be still valid
            ->orderByRaw('((price - sale_price) / price * 100) DESC')
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'success' => true,
            'data' => $deal
        ]);
    }

    #[OA\Get(
        path: '/api/courses/featured-workshop',
        operationId: 'getFeaturedWorkshop',
        tags: ['Khóa học'],
        summary: 'Lấy Workshop nổi bật',
        description: 'Lấy workshop đầu tiên được đánh dấu là nổi bật',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            )
        ]
    )]
    public function featuredWorkshop()
    {
        $workshop = \App\Models\Course::where('format', 'workshop')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'success' => true,
            'data' => $workshop
        ]);
    }

    #[OA\Get(
        path: '/api/courses/{slug}',
        operationId: 'getCourseDetail',
        tags: ['Khóa học'],
        summary: 'Chi tiết khóa học',
        description: 'Lấy thông tin chi tiết của một khóa học theo slug',
        parameters: [
            new OA\Parameter(
                name: 'slug',
                in: 'path',
                required: true,
                description: 'Slug của khóa học',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'data', type: 'object'),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Không tìm thấy khóa học'
            )
        ]
    )]
    public function show($slug)
    {
        $query = \App\Models\Course::where('is_active', true);

        if (is_numeric($slug)) {
            $query->where('id', $slug);
        } else {
            $query->where('slug', $slug);
        }

        $course = $query->first();

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }
}
