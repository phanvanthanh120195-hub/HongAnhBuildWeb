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

        // Sort by featured first if requested
        if ($request->has('featured_priority')) {
            $query->orderBy('is_featured', 'desc');
        }

        if ($request->filled('category_ids')) {
            $categoryIds = explode(',', $request->input('category_ids'));
            $query->whereIn('product_category_id', $categoryIds);
        }

        if ($request->filled('labels')) {
            $labels = explode(',', $request->input('labels'));
            $query->whereIn('label', $labels);
        }

        if ($request->filled('price_range')) {
            $ranges = explode(',', $request->input('price_range'));
            $query->where(function ($q) use ($ranges) {
                foreach ($ranges as $range) {
                    $parts = explode('-', $range);
                    if (count($parts) === 2) {
                        $min = (float) $parts[0];
                        $max = (float) $parts[1];
                        $q->orWhereBetween('price', [$min, $max]); 
                    }
                }
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'newest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc'); // Or sale_price if logic dictates
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $limit = $request->input('limit', 12);

        $products = $query->paginate($limit, [
            'id', 
            'name', 
            'thumbnail', 
            'price', 
            'sale_price', 
            'label', 
            'is_featured', 
            'discount_percent',
            'description' // Added description
        ]);

        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }
}
