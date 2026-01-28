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
    public function index()
    {
        $courses = \App\Models\Course::where('is_active', true)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }
}
