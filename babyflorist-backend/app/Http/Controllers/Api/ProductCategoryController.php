<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use OpenApi\Attributes as OA;

class ProductCategoryController extends Controller
{
    #[OA\Get(
        path: '/api/categories',
        operationId: 'getCategoriesList',
        tags: ['Danh mục sản phẩm'],
        summary: 'Lấy danh sách danh mục',
        description: 'Trả về danh sách tất cả danh mục sản phẩm đang hoạt động',
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
                                    new OA\Property(property: 'name', type: 'string', example: 'Hoa sinh nhật'),
                                    new OA\Property(property: 'slug', type: 'string', example: 'hoa-sinh-nhat'),
                                    new OA\Property(property: 'description', type: 'string', example: 'Các loại hoa dành cho sinh nhật'),
                                    new OA\Property(property: 'parent_id', type: 'integer', nullable: true, example: null),
                                    new OA\Property(property: 'sort_order', type: 'integer', example: 1),
                                    new OA\Property(property: 'is_active', type: 'boolean', example: true),
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
        $categories = ProductCategory::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    #[OA\Get(
        path: '/api/categories/{id}',
        operationId: 'getCategoryById',
        tags: ['Danh mục sản phẩm'],
        summary: 'Lấy chi tiết danh mục',
        description: 'Trả về thông tin chi tiết của một danh mục theo ID',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'ID của danh mục',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công'
            ),
            new OA\Response(
                response: 404,
                description: 'Không tìm thấy danh mục'
            )
        ]
    )]
    public function show($id)
    {
        $category = ProductCategory::with('children', 'products')->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy danh mục'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
