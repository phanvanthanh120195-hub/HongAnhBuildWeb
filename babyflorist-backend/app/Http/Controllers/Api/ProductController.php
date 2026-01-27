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
        tags: ['Products'],
        summary: 'Get list of products',
        description: 'Returns list of products',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden'
            )
        ]
    )]
    public function index()
    {
        return response()->json([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Sample Product',
                    'price' => 100000
                ]
            ]
        ]);
    }
}
