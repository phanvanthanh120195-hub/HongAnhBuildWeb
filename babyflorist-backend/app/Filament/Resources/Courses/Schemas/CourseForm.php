<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                            // LEFT COLUMN
                            Group::make()
                                ->schema([
                                    Section::make('Thông tin khóa học')
                                        ->schema([
                                            Grid::make(2)->schema([
                                                Select::make('format')
                                                    ->label('Loại nội dung')
                                                    ->options([
                                                        'course' => 'Khóa học',
                                                        'workshop' => 'Workshop',
                                                    ])
                                                    ->default('course')
                                                    ->native(false)
                                                    ->live(),
                                                Select::make('type')
                                                    ->label('Hình thức học')
                                                    ->options([
                                                        'offline' => 'Học offline',
                                                        'online' => 'Học online',
                                                    ])
                                                    ->default('offline')
                                                    ->native(false),
                                            ]),

                                            Grid::make(2)->schema([
                                                Select::make('course_category_id')
                                                    ->label('Danh mục')
                                                    ->relationship('category', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->required()
                                                    ->default(null)
                                                    ->visible(fn(Get $get) => $get('format') !== 'workshop'),
                                                Select::make('label')
                                                    ->label('Cấp độ')
                                                    ->options([
                                                        'basic' => 'Cơ bản',
                                                        'advanced' => 'Nâng cao',
                                                    ])
                                                    ->default('basic')
                                                    ->native(false)
                                                    ->searchable()
                                                    ->visible(fn(Get $get) => $get('format') !== 'workshop'),
                                            ]),

                                            FileUpload::make('thumbnail')
                                                ->label(fn(Get $get) => $get('format') !== 'workshop' ? 'Hình ảnh' : 'Ảnh bìa')
                                                ->image()
                                                ->disk('public')
                                                ->directory('course-thumbnails')
                                                ->columnSpanFull(),

                                            TextInput::make('name')
                                                ->label('Tên khóa học')
                                                ->required()
                                                ->unique(ignoreRecord: true)
                                                ->live(onBlur: true)
                                                ->afterStateUpdated(fn(Set $set, ?string $state) => $state ? $set('slug', Str::slug($state)) : null),

                                            TextInput::make('slug')
                                                ->label('Đường dẫn (Slug)')
                                                ->disabled()
                                                ->dehydrated(),

                                            TextInput::make('subtitle')
                                                ->label('Tiêu đề phụ')
                                                ->placeholder('VD: Khóa học cắm hoa nghệ thuật')
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                            TextInput::make('location')
                                                ->label('Địa điểm tổ chức')
                                                ->placeholder('VD: 123 Đường ABC, Quận 1, TP.HCM')
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                            Textarea::make('description')
                                                ->label('Mô tả ngắn')
                                                ->rows(3)
                                                ->columnSpanFull(),

                                            \Filament\Forms\Components\RichEditor::make('content')
                                                ->label('Nội dung chi tiết')
                                                ->columnSpanFull()
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                            Repeater::make('highlights')
                                                ->label('Điểm nổi bật (Lợi ích khóa học)')
                                                ->relationship()
                                                ->schema([
                                                    TextInput::make('content')
                                                        ->label('Nội dung')
                                                        ->columnSpanFull(),
                                                ])
                                                ->orderColumn('sort_order')
                                                ->defaultItems(0)
                                                ->addActionLabel('+ Thêm điểm nổi bật')
                                                ->itemLabel(fn(array $state): ?string => $state['content'] ?? 'Điểm nổi bật mới')
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed()
                                                ->visible(fn(Get $get) => $get('format') !== 'workshop'),
                                        ]),

                                    // Lộ trình đào tạo (Curriculum)
                                    Section::make('Lộ trình đào tạo')
                                        ->description('Thêm các chương và nội dung bài học')
                                        ->schema([
                                            Repeater::make('curriculums')
                                                ->label('')
                                                ->relationship()
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->label('Tên chương')
                                                        ->placeholder('VD: Chương 1: Tổng quan về Hoa Tết')
                                                        ->columnSpanFull(),

                                                    Textarea::make('description')
                                                        ->label('Mô tả chương')
                                                        ->rows(2)
                                                        ->placeholder('Mô tả nội dung chương học...')
                                                        ->columnSpanFull(),

                                                    Repeater::make('items')
                                                        ->label('Nội dung bài học')
                                                        ->relationship()
                                                        ->schema([
                                                            Select::make('icon')
                                                                ->label('Loại')
                                                                ->options([
                                                                    'eco' => 'Lá',
                                                                    'spa' => 'Spa',
                                                                    'alette' => 'Cọ vẽ',
                                                                    'local_florist' => 'Hoa',
                                                                    'build_circl' => 'Dụng cụ',
                                                                    'category' => 'Quy tắc',
                                                                    'assignment' => 'Bài tập',
                                                                    'water_drop' => 'Nước',
                                                                    'quiz' => 'Quiz',
                                                                    'video' => 'Video',
                                                                    'article' => 'Đề thi',
                                                                    'brush' => 'Bút ký',
                                                                    'to_camera' => 'Camera',
                                                                    'book' => 'Tài liệu',
                                                                ])
                                                                ->default('local_florist')
                                                                ->native(false),

                                                            TextInput::make('content')
                                                                ->label('Nội dung')
                                                                ->placeholder('VD: Ý nghĩa các loài hoa truyền thống ngày Tết')
                                                                ->columnSpan(2),
                                                        ])
                                                        ->columns(3)
                                                        ->addActionLabel('+ Thêm nội dung')
                                                        ->reorderable()
                                                        ->collapsible()
                                                        ->itemLabel(fn(array $state): ?string => $state['content'] ?? 'Nội dung mới')
                                                        ->defaultItems(0)
                                                        ->addActionAlignment('end'),
                                                ])
                                                ->addActionLabel('+ Thêm lộ trình')
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed()
                                                ->cloneable()
                                                ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Chương mới')
                                                ->defaultItems(0)
                                        ])
                                        ->collapsible()
                                        ->visible(fn(Get $get) => $get('format') !== 'workshop'),

                                    // FAQ - Câu hỏi thường gặp
                                    Section::make('FAQ - Câu hỏi thường gặp')
                                        ->description('Thêm các câu hỏi và trả lời thường gặp')
                                        ->schema([
                                            Repeater::make('faqs')
                                                ->label('')
                                                ->relationship()
                                                ->schema([
                                                    TextInput::make('question')
                                                        ->label('Câu hỏi')
                                                        ->placeholder('VD: Tôi chưa từng cắm hoa có học được không?')
                                                        ->columnSpanFull(),

                                                    Textarea::make('answer')
                                                        ->label('Trả lời')
                                                        ->rows(2)
                                                        ->placeholder('Nhập câu trả lời...')
                                                        ->columnSpanFull(),
                                                ])
                                                ->addActionLabel('+ Thêm FAQ')
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed()
                                                ->cloneable()
                                                ->itemLabel(fn(array $state): ?string => $state['question'] ?? 'Câu hỏi mới')
                                                ->defaultItems(0),
                                        ])
                                        ->collapsible()
                                        ->visible(fn(Get $get) => $get('format') !== 'workshop'),

                                    // Bạn Sẽ Nhận Được Gì? (Benefits)
                                    Section::make('Bạn Sẽ Nhận Được Gì?')
                                        ->schema([
                                            Repeater::make('benefits')
                                                ->label('')
                                                ->relationship()
                                                ->schema([
                                                    Select::make('icon')
                                                        ->label('Loại')
                                                        ->options([
                                                            'eco' => 'Lá',
                                                            'spa' => 'Spa',
                                                            'alette' => 'Cọ vẽ',
                                                            'local_florist' => 'Hoa',
                                                            'build_circl' => 'Dụng cụ',
                                                            'category' => 'Quy tắc',
                                                            'assignment' => 'Bài tập',
                                                            'water_drop' => 'Nước',
                                                            'quiz' => 'Quiz',
                                                            'video' => 'Video',
                                                            'article' => 'Đề thi',
                                                            'brush' => 'Bút ký',
                                                            'to_camera' => 'Camera',
                                                            'book' => 'Tài liệu',
                                                        ])
                                                        ->default('local_florist')
                                                        ->native(false),

                                                    TextInput::make('title')
                                                        ->label('Tiêu đề')
                                                        ->placeholder('VD: Sắp mâm chuẩn phong thủy'),

                                                    Textarea::make('description')
                                                        ->label('Mô tả')
                                                        ->rows(2)
                                                        ->columnSpanFull(),
                                                ])
                                                ->columns(2)
                                                ->addActionLabel('+ Thêm lợi ích')
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed()
                                                ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Lợi ích mới')
                                                ->defaultItems(0),
                                        ])
                                        ->collapsible()
                                        ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                    // Trải Nghiệm Tại Workshop (Experiences)
                                    Section::make('Trải Nghiệm Tại Workshop')
                                        ->schema([
                                            Repeater::make('experiences')
                                                ->label('')
                                                ->relationship()
                                                ->schema([
                                                    FileUpload::make('image')
                                                        ->label('Hình ảnh')
                                                        ->image()
                                                        ->directory('workshop-experiences')
                                                        ->columnSpanFull(),

                                                    TextInput::make('title')
                                                        ->label('Tiêu đề')
                                                        ->required(),

                                                    Textarea::make('description')
                                                        ->label('Mô tả')
                                                        ->rows(2)
                                                        ->columnSpanFull(),
                                                ])
                                                ->addActionLabel('+ Thêm trải nghiệm')
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed()
                                                ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Trải nghiệm mới')
                                                ->defaultItems(0),
                                        ])
                                        ->collapsible()
                                        ->visible(fn(Get $get) => $get('format') === 'workshop'),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 8,
                                ]),

                            // RIGHT COLUMN
                            Group::make()
                                ->schema([
                                    Section::make('Hướng dẫn')
                                        ->schema([
                                            \Filament\Forms\Components\Placeholder::make('workshop_instruction')
                                                ->hiddenLabel()
                                                ->content('Lưu ý: Nếu loại nội dung là workshop, hãy chọn nổi bật và thêm hiệu lực từ - đến workshop ở bên dưới để hiện thị!')
                                                ->extraAttributes(['class' => 'text-primary-600 font-bold']),
                                        ])
                                        ->visible(fn(Get $get) => $get('format') === 'workshop'),
                                    Section::make('Trạng thái')
                                        ->schema([
                                            Toggle::make('is_featured')
                                                ->label('Nổi bật')
                                                ->helperText('Nội dung sẽ được hiển thị ở mục nổi bật trang chủ')
                                                ->default(false)
                                                ->onColor('success')
                                                ->inline(false)
                                                ->offColor('gray'),

                                            Toggle::make('is_active')
                                                ->label('Hiển thị')
                                                ->helperText('Bật để hiển thị Khóa học - Workshop')
                                                ->default(true)
                                                ->inline(false),
                                        ]),

                                    Section::make('Giá & Số liệu')
                                        ->schema([
                                            TextInput::make('price')
                                                ->label('Giá gốc')
                                                ->required()
                                                ->suffix('₫')
                                                ->live(onBlur: true)
                                                ->formatStateUsing(fn($state) => $state ? number_format($state, 0) : null)
                                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                                    $discount = (float) $get('discount_percent');
                                                    if ($state) {
                                                        $numericPrice = (float) str_replace(',', '', $state);
                                                        $set('price', number_format($numericPrice));
                                                        if ($discount > 0) {
                                                            $set('sale_price', number_format($numericPrice * (1 - $discount / 100)));
                                                        }
                                                    }
                                                })
                                                ->dehydrateStateUsing(fn($state) => (float) str_replace(',', '', $state)),

                                            TextInput::make('discount_percent')
                                                ->label('Giảm giá (%)')
                                                ->numeric()
                                                ->minValue(0)
                                                ->maxValue(100)
                                                ->live(onBlur: true)
                                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                                    $priceState = $get('price');
                                                    $price = (float) str_replace(',', '', $priceState);

                                                    if ($price > 0 && $state !== null) {
                                                        $discount = (float) $state;
                                                        $set('sale_price', number_format($price * (1 - ($discount / 100))));
                                                    }
                                                })
                                                ->visible(fn(Get $get) => $get('format') !== 'workshop'),

                                            TextInput::make('sale_price')
                                                ->label('Giá khuyến mãi')
                                                ->suffix('₫')
                                                ->default(null)
                                                ->formatStateUsing(fn($state) => $state ? number_format($state, 0) : null)
                                                ->dehydrateStateUsing(fn($state) => $state ? (float) str_replace(',', '', $state) : null)
                                                ->visible(fn(Get $get) => $get('format') !== 'workshop'),

                                            Grid::make(2)->schema([
                                                TextInput::make('lesson_count')
                                                    ->label('Số bài học')
                                                    ->numeric()
                                                    ->default(0)
                                                    ->live()
                                                    ->dehydrated()
                                                    ->afterStateHydrated(fn(TextInput $component, $state) => $component->state($state ?? 0))
                                                    ->dehydrateStateUsing(fn($state) => (int) $state)
                                                    ->visible(fn(Get $get) => $get('format') !== 'workshop'),

                                                TextInput::make('student_count')
                                                    ->label('Số học viên')
                                                    ->required()
                                                    ->numeric()
                                                    ->default(0),
                                            ]),

                                            TextInput::make('instructor')
                                                ->label('Giảng viên')
                                                ->default('Phan Hồng Anh')
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                            \Filament\Forms\Components\DateTimePicker::make('start_time')
                                                ->label('Thời gian bắt đầu')
                                                ->seconds(false)
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),

                                            \Filament\Forms\Components\DateTimePicker::make('end_time')
                                                ->label('Thời gian kết thúc')
                                                ->seconds(false)
                                                ->visible(fn(Get $get) => $get('format') === 'workshop'),
                                        ]),

                                    Section::make('Hiệu lực')
                                        ->schema([
                                            \Filament\Forms\Components\DateTimePicker::make('sale_start')
                                                ->label(fn(Get $get) => $get('format') === 'workshop' ? 'Hiệu lực từ' : 'Hiệu lực từ'),

                                            \Filament\Forms\Components\DateTimePicker::make('sale_end')
                                                ->label(fn(Get $get) => $get('format') === 'workshop' ? 'Hiệu lực đến' : 'Hiệu lực đến')
                                                ->afterOrEqual('sale_start'),
                                        ])
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 4,
                                ]),
                        ]),
            ]);
    }
}
