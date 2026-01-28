<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class AboutUsController extends Controller
{
    #[OA\Get(
        path: '/api/about-us',
        operationId: 'getAboutUs',
        tags: ['About Us'],
        summary: 'Lấy thông tin Về chúng tôi',
        description: 'Trả về thông tin giới thiệu, hình ảnh, và các liên kết mạng xã hội',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Thành công',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'status', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'name', type: 'string', example: 'Hồng Anh'),
                                new OA\Property(property: 'image', type: 'string', example: 'about-us/image.jpg'),
                                new OA\Property(property: 'description', type: 'string', example: '<p>Mô tả...</p>'),
                                new OA\Property(property: 'facebook', type: 'string', example: 'https://facebook.com/...'),
                                new OA\Property(property: 'instagram', type: 'string', example: 'https://instagram.com/...'),
                                new OA\Property(property: 'phone', type: 'string', example: '0123456789'),
                                new OA\Property(property: 'zalo', type: 'string', example: '0123456789'),
                                new OA\Property(property: 'email', type: 'string', example: 'contact@example.com'),
                            ]
                        ),
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $aboutUs = \App\Models\AboutUs::first();
        return response()->json([
            'status' => true,
            'data' => $aboutUs
        ]);
    }
}
