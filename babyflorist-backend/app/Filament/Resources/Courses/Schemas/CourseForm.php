<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
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
                                            Select::make('type')
                                                ->label('Loại khóa học')
                                                ->options([
                                                    'offline' => 'Offline',
                                                    'online' => 'Online',
                                                ])
                                                ->default('offline')
                                                ->required()
                                                ->native(false),

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

                                            TextInput::make('instructor')
                                                ->label('Giảng viên'),

                                            FileUpload::make('thumbnail')
                                                ->label('Hình ảnh')
                                                ->image()
                                                ->disk('public')
                                                ->directory('course-thumbnails')
                                                ->columnSpanFull(),

                                            Textarea::make('description')
                                                ->label('Mô tả')
                                                ->rows(4)
                                                ->columnSpanFull()
                                                ->extraInputAttributes([
                                                    'style' => 'min-height: 250px;',
                                                ]),
                                        ]),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 8,
                                ]),

                            // RIGHT COLUMN
                            Group::make()
                                ->schema([
                                    Section::make('Trạng thái')
                                        ->schema([
                                            Toggle::make('is_active')
                                                ->label('Hiển thị')
                                                ->default(true),
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
                                                }),

                                            TextInput::make('sale_price')
                                                ->label('Giá khuyến mãi')
                                                ->suffix('₫')
                                                ->default(null)
                                                ->formatStateUsing(fn($state) => $state ? number_format($state, 0) : null)
                                                ->dehydrateStateUsing(fn($state) => $state ? (float) str_replace(',', '', $state) : null),

                                            TextInput::make('lesson_count')
                                                ->label('Số bài học')
                                                ->numeric()
                                                ->default(0),

                                            TextInput::make('student_count')
                                                ->label('Số học viên')
                                                ->required()
                                                ->numeric()
                                                ->default(0),

                                            \Filament\Forms\Components\DateTimePicker::make('sale_start')
                                                ->label('Hiệu lực từ'),

                                            \Filament\Forms\Components\DateTimePicker::make('sale_end')
                                                ->label('Hiệu lực đến')
                                                ->afterOrEqual('sale_start'),
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
