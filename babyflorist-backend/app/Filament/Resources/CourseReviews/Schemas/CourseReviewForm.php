<?php

namespace App\Filament\Resources\CourseReviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                            // LEFT COLUMN (Main Info)
                            Group::make()
                                ->schema([
                                    Section::make('Thông tin đánh giá')
                                        ->schema([
                                            Select::make('course_id')
                                                ->label('Khóa học')
                                                ->relationship('course', 'name')
                                                ->searchable()
                                                ->preload()
                                                ->required(),

                                            Grid::make([
                                                'default' => 1,
                                                'lg' => 2,
                                            ])->schema([
                                                        Select::make('customer_id')
                                                            ->label('Khách hàng')
                                                            ->relationship('customer', 'name')
                                                            ->searchable()
                                                            ->preload()
                                                            ->helperText('Để trống sẽ tự động tạo tên ẩn danh ID'),

                                                        TextInput::make('reviewer_name')
                                                            ->label('Tên người đánh giá')
                                                            ->placeholder('Để trống sẽ tự động tạo tên ẩn danh'),
                                                    ]),

                                            Radio::make('rating')
                                                ->label('Đánh giá')
                                                ->options([
                                                    1 => '⭐ (1)',
                                                    2 => '⭐⭐ (2)',
                                                    3 => '⭐⭐⭐ (3)',
                                                    4 => '⭐⭐⭐⭐ (4)',
                                                    5 => '⭐⭐⭐⭐⭐ (5)',
                                                ])
                                                ->inline()
                                                ->required(),

                                            Textarea::make('content')
                                                ->label('Nội dung')
                                                ->rows(3)
                                                ->columnSpanFull(),
                                        ]),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 8,
                                ]),

                            // RIGHT COLUMN (Settings)
                            Group::make()
                                ->schema([
                                    Section::make('Trạng thái')
                                        ->schema([
                                            Toggle::make('is_active')
                                                ->label('Hiển thị')
                                                ->default(false),
                                        ]),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 4,
                                ]),
                        ]),
            ]);
    }
}
