<?php

namespace App\Filament\Resources\FeaturedReview\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeaturedReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    Group::make()->schema([
                        Section::make('Chọn Review Gốc')
                            ->description('Chọn đánh giá từ sản phẩm hoặc khóa học để làm nổi bật.')
                            ->schema([
                                Select::make('source_type')
                                    ->label('Nguồn đánh giá')
                                    ->options([
                                        'product' => 'Sản phẩm',
                                        'course' => 'Khóa học',
                                    ])
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(fn($state, callable $set) => $set('source_id', null)),

                                Select::make('source_id')
                                    ->label('Chọn đánh giá')
                                    ->options(function (callable $get) {
                                        $sourceType = $get('source_type');
                                        if (!$sourceType) {
                                            return [];
                                        }

                                        if ($sourceType === 'product') {
                                            return \App\Models\ProductReview::with(['product', 'customer'])
                                                ->where('is_active', true)
                                                ->latest()
                                                ->get()
                                                ->mapWithKeys(function ($review) {
                                                    $rating = $review->rating ?? 0;
                                                    $productName = $review->product->name;
                                                    $customerName = $review->customer?->name ?? 'Khách lẻ';
                                                    $content = str($review->content)->limit(30);

                                                    $label = "⭐{$rating}/5 {$productName} - {$customerName}: {$content}";
                                                    return [$review->id => $label];
                                                });
                                        }

                                        if ($sourceType === 'course') {
                                            return \App\Models\CourseReview::with(['course', 'customer'])
                                                ->where('is_active', true)
                                                ->whereHas('course', fn($q) => $q->where('is_active', true))
                                                ->latest()
                                                ->get()
                                                ->mapWithKeys(function ($review) {
                                                    $rating = $review->rating ?? 0;
                                                    $courseName = $review->course->title;
                                                    $customerName = $review->customer?->name ?? 'Khách lẻ';
                                                    $content = str($review->content)->limit(30);

                                                    $label = "⭐{$rating}/5 {$courseName} - {$customerName}: {$content}";
                                                    return [$review->id => $label];
                                                });
                                        }

                                        return [];
                                    })
                                    ->disableOptionWhen(function ($value, callable $get, ?\Illuminate\Database\Eloquent\Model $record) {
                                        static $disabledIds = null;

                                        if ($disabledIds === null) {
                                            $type = $get('source_type');
                                            if (!$type) {
                                                $disabledIds = [];
                                            } else {
                                                $disabledIds = \App\Models\FeaturedReview::where('source_type', $type)
                                                    ->when($record, fn($q) => $q->where('id', '!=', $record->id))
                                                    ->pluck('source_id')
                                                    ->map(fn($id) => (string) $id)
                                                    ->all();
                                            }
                                        }

                                        return in_array((string) $value, $disabledIds);
                                    })
                                    ->required()
                                    ->searchable()
                                    ->live(),

                                Placeholder::make('original_preview')
                                    ->label('Nội dung gốc (Read-only)')
                                    ->content(function (callable $get) {
                                        $type = $get('source_type');
                                        $id = $get('source_id');
                                        if (!$type || !$id)
                                            return 'Chưa chọn review...';

                                        $review = null;
                                        if ($type === 'product')
                                            $review = \App\Models\ProductReview::find($id);
                                        if ($type === 'course')
                                            $review = \App\Models\CourseReview::find($id);

                                        if (!$review)
                                            return 'Không tìm thấy review';

                                        $customerName = $review->customer?->name ?? 'Khách lẻ/Ẩn danh';

                                        return new \Illuminate\Support\HtmlString("
                                            <div class='p-4 bg-gray-50 rounded-lg border text-sm'>
                                                <div class='font-bold text-primary'>“{$review->content}”</div>
                                                <div class='mt-2 flex items-center gap-2'>
                                                    <span>⭐ {$review->rating}/5</span>
                                                    <span class='text-gray-500'>• {$customerName}</span>
                                                </div>
                                            </div>
                                        ");
                                    })
                                    ->visible(fn(callable $get) => $get('source_id')),
                            ]),

                        Section::make('Tùy Biến Marketing')
                            ->description('Thay đổi thông tin hiển thị để thu hút hơn.')
                            ->schema([
                                TextInput::make('display_name')
                                    ->label('Tên hiển thị')
                                    ->helperText('VD: Chị Mai Lan (Để trống sẽ lấy tên gốc)')
                                    ->maxLength(255),

                                TextInput::make('display_label')
                                    ->label('Nhãn mô tả')
                                    ->placeholder('VD: Học viên lớp Cơ bản')
                                    ->helperText('Hiển thị dưới tên người đánh giá'),

                                FileUpload::make('display_avatar')
                                    ->label('Avatar hiển thị')
                                    ->image()
                                    ->directory('featured-reviews-avatars')
                                    ->avatar(),
                            ]),
                    ])->columnSpan(2),

                    Group::make()->schema([
                        Section::make('Trạng thái')
                            ->schema([
                                TextInput::make('display_order')
                                    ->label('Thứ tự hiển thị')
                                    ->numeric()
                                    ->default(0)
                                    ->dehydrateStateUsing(fn($state) => $state ?? 0),

                                Toggle::make('is_active')
                                    ->label('Hiển thị trên web')
                                    ->default(true)
                                    ->helperText('Bật/tắt nhanh sự xuất hiện ngoài trang chủ'),
                            ]),
                    ])->columnSpan(1),
                ]),
            ]);
    }
}
