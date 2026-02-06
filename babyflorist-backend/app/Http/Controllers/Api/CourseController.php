<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCurriculum;
use App\Models\CourseCurriculumItem;
use App\Models\CourseFAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $query = \App\Models\Course::where('is_active', true)->withCount('enrollments');

        // Filter by format (optional)
        if ($request->has('format')) {
            $query->where('format', $request->input('format'));
        }

        // Sort by featured first if requested
        if ($request->has('featured_priority')) {
            $query->orderBy('is_featured', 'desc');
        }

        // Default sort
        $query->orderBy('created_at', 'desc');

        // Filter by Categories
        if ($request->has('categories')) {
            $categories = explode(',', $request->input('categories'));
            if (!empty($categories)) {
                $query->whereIn('course_category_id', $categories);
            }
        }

        // Filter by Levels (labels)
        if ($request->has('levels')) {
            $levels = explode(',', $request->input('levels'));
            $mappedLevels = [];
            foreach ($levels as $level) {
                if ($level === 'Cơ bản')
                    $mappedLevels[] = 'basic';
                if ($level === 'Nâng cao')
                    $mappedLevels[] = 'advanced';
            }
            if (!empty($mappedLevels)) {
                $query->whereIn('label', $mappedLevels);
            }
        }

        // Filter by Price Ranges
        if ($request->has('price_ranges')) {
            $ranges = explode(',', $request->input('price_ranges'));
            $query->where(function ($q) use ($ranges) {
                foreach ($ranges as $range) {
                    if ($range === 'under-500k') {
                        $q->orWhere(function ($subQ) {
                            $subQ->whereRaw('COALESCE(sale_price, price) < 500000');
                        });
                    } elseif ($range === '500k-1m') {
                        $q->orWhere(function ($subQ) {
                            $subQ->whereRaw('COALESCE(sale_price, price) >= 500000 AND COALESCE(sale_price, price) <= 1000000');
                        });
                    } elseif ($range === 'above-1m') {
                        $q->orWhere(function ($subQ) {
                            $subQ->whereRaw('COALESCE(sale_price, price) > 1000000');
                        });
                    }
                }
            });
        }

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

        $course->load([
            'curriculums' => function($q) { $q->orderBy('sort_order'); },
            'curriculums.items' => function($q) { $q->orderBy('sort_order'); },
            'faqs' => function($q) { $q->orderBy('sort_order'); },
            'reviews' => function($q) { $q->where('is_active', true)->orderByDesc('created_at')->with('customer'); },
            'highlights' => function($q) { $q->orderBy('sort_order'); }
        ]);

        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    /**
     * Store a new course with nested data (curriculums, items, FAQs)
     * Uses database transaction to ensure data integrity
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course' => 'required|array',
            'course.name' => 'required|string|max:255',
            'course.slug' => 'required|string|max:255|unique:courses,slug',
            'targets' => 'nullable|array',
            'targets.*' => 'string',
            'curriculums' => 'nullable|array',
            'curriculums.*.title' => 'required|string|max:255',
            'curriculums.*.items' => 'nullable|array',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // 1. Create the course first
            $courseData = $request->input('course');
            $courseData['targets'] = $request->input('targets', []);
            $course = Course::create($courseData);

            // 2. Save curriculums with nested items
            $curriculums = $request->input('curriculums', []);
            foreach ($curriculums as $index => $curriculumData) {
                $curriculum = CourseCurriculum::create([
                    'course_id' => $course->id,
                    'title' => $curriculumData['title'],
                    'description' => $curriculumData['description'] ?? null,
                    'sort_order' => $index, // Sort order based on FE array order
                ]);

                // Save curriculum items
                $items = $curriculumData['items'] ?? [];
                foreach ($items as $itemIndex => $itemData) {
                    CourseCurriculumItem::create([
                        'curriculum_id' => $curriculum->id,
                        'icon' => $itemData['icon'] ?? null,
                        'content' => $itemData['content'],
                        'sort_order' => $itemIndex,
                    ]);
                }
            }

            // 3. Save FAQs
            $faqs = $request->input('faqs', []);
            foreach ($faqs as $faqIndex => $faqData) {
                CourseFAQ::create([
                    'course_id' => $course->id,
                    'question' => $faqData['question'],
                    'answer' => $faqData['answer'],
                    'sort_order' => $faqIndex,
                ]);
            }

            DB::commit();

            // Load relationships for response
            $course->load(['curriculums.items', 'faqs']);

            return response()->json([
                'success' => true,
                'message' => 'Course created successfully',
                'data' => $course
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create course',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing course with nested data
     * Deletes all child records and re-inserts based on new payload
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'course' => 'required|array',
            'course.name' => 'required|string|max:255',
            'course.slug' => 'required|string|max:255|unique:courses,slug,' . $id,
            'targets' => 'nullable|array',
            'targets.*' => 'string',
            'curriculums' => 'nullable|array',
            'curriculums.*.title' => 'required|string|max:255',
            'curriculums.*.items' => 'nullable|array',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // 1. Update course data
            $courseData = $request->input('course');
            $courseData['targets'] = $request->input('targets', []);
            $course->update($courseData);

            // 2. Delete existing child records (cascade will handle curriculum_items via FK)
            // We need to manually delete curriculum_items first because of the FK constraint
            $curriculumIds = $course->curriculums()->pluck('id');
            CourseCurriculumItem::whereIn('curriculum_id', $curriculumIds)->delete();
            $course->curriculums()->delete();
            $course->faqs()->delete();

            // 3. Re-insert curriculums with nested items
            $curriculums = $request->input('curriculums', []);
            foreach ($curriculums as $index => $curriculumData) {
                $curriculum = CourseCurriculum::create([
                    'course_id' => $course->id,
                    'title' => $curriculumData['title'],
                    'description' => $curriculumData['description'] ?? null,
                    'sort_order' => $index,
                ]);

                // Save curriculum items
                $items = $curriculumData['items'] ?? [];
                foreach ($items as $itemIndex => $itemData) {
                    CourseCurriculumItem::create([
                        'curriculum_id' => $curriculum->id,
                        'icon' => $itemData['icon'] ?? null,
                        'content' => $itemData['content'],
                        'sort_order' => $itemIndex,
                    ]);
                }
            }

            // 4. Re-insert FAQs
            $faqs = $request->input('faqs', []);
            foreach ($faqs as $faqIndex => $faqData) {
                CourseFAQ::create([
                    'course_id' => $course->id,
                    'question' => $faqData['question'],
                    'answer' => $faqData['answer'],
                    'sort_order' => $faqIndex,
                ]);
            }

            DB::commit();

            // Load relationships for response
            $course->load(['curriculums.items', 'faqs']);

            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully',
                'data' => $course
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update course',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
