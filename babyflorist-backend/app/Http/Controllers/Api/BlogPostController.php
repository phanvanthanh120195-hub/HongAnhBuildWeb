<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class BlogPostController extends Controller
{
    #[OA\Get(
        path: '/api/blogs',
        operationId: 'getBlogPostsList',
        tags: ['Blog'],
        summary: 'Lấy danh sách bài viết',
        description: 'Trả về danh sách tất cả các bài viết đang hoạt động',
        parameters: [
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 10)),
            new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
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
                                    new OA\Property(property: 'title', type: 'string', example: 'Bài viết mẫu'),
                                    new OA\Property(property: 'slug', type: 'string', example: 'bai-viet-mau'),
                                    new OA\Property(property: 'thumbnail', type: 'string', example: 'blogs/thumbnail.jpg'),
                                    new OA\Property(property: 'content', type: 'string'),
                                    new OA\Property(property: 'published_at', type: 'string', format: 'date'),
                                    new OA\Property(property: 'category', type: 'object'),
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
        $query = BlogPost::where('is_active', true)
            ->with(['category']);

        if ($request->has('category_id')) {
            $query->where('blog_category_id', $request->category_id);
        }

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->has('featured_priority')) {
            $query->orderBy('is_featured', 'desc');
        }

        $query->orderBy('published_at', 'desc');

        $limit = $request->get('limit', 10);
        
        // Use paginate instead of limit for pagination support
        $posts = $query->paginate($limit);

        // Transform data for frontend
        $data = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'thumbnail' => $post->thumbnail ? asset('storage/' . $post->thumbnail) : null,
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($post->content), 100),
                'content' => $post->content,
                'published_at' => $post->published_at ? $post->published_at->format('d') . ' Tháng ' . $post->published_at->format('n') . ', ' . $post->published_at->format('Y') : null,
                'category' => $post->category ? $post->category->name : null,
                'is_featured' => $post->is_featured,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    #[OA\Get(
        path: '/api/blogs/{slug}',
        operationId: 'getBlogPostBySlug',
        tags: ['Blog'],
        summary: 'Lấy chi tiết bài viết theo slug',
        parameters: [
            new OA\Parameter(name: 'slug', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Thành công'),
            new OA\Response(response: 404, description: 'Không tìm thấy')
        ]
    )]
    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'tags'])
            ->first();

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'thumbnail' => $post->thumbnail ? asset('storage/' . $post->thumbnail) : null,
                'published_at' => $post->published_at ? $post->published_at->format('M d, Y') : null,
                'category' => $post->category,
                'tags' => $post->tags,
            ]
        ]);
    }
}
