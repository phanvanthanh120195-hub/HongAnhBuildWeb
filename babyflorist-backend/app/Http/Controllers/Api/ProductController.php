<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    #[OA\Get(
        path: '/api/products',
        operationId: 'getProductsList',
        tags: ['Sản phẩm'],
        summary: 'Lấy danh sách sản phẩm',
        description: 'Trả về danh sách 4 sản phẩm mới nhất đang hoạt động',
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
                                    new OA\Property(property: 'name', type: 'string', example: 'Hoa hồng Queen'),
                                    new OA\Property(property: 'thumbnail', type: 'string', example: 'products/thumbnail.jpg'),
                                    new OA\Property(property: 'price', type: 'number', example: 300000),
                                    new OA\Property(property: 'sale_price', type: 'number', nullable: true, example: 250000),
                                    new OA\Property(property: 'label', type: 'string', nullable: true, example: 'sale'),
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
        $query = Product::where('is_active', true);

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->has('label_new')) {
            $query->where('label', 'new');
        }

        $products = $query->orderBy('id', 'desc')
            ->limit(4)
            ->get(['id', 'name', 'thumbnail', 'price', 'sale_price', 'label', 'is_featured']);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
