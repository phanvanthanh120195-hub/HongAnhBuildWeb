<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CourseCategoryController extends Controller
{
    #[OA\Get(
        path: '/api/course-categories',
        operationId: 'getCourseCategoriesList',
        tags: ['Khóa học'],
        summary: 'Lấy danh sách danh mục khóa học',
        description: 'Trả về danh sách tất cả các danh mục khóa học đang hoạt động',
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
                                    new OA\Property(property: 'name', type: 'string', example: 'Cắm hoa bình'),
                                    new OA\Property(property: 'slug', type: 'string', example: 'cam-hoa-binh'),
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
        $categories = CourseCategory::where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}
