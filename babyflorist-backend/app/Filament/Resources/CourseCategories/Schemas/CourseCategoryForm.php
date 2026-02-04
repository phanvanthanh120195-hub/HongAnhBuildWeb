<?php

namespace App\Filament\Resources\CourseCategories\Schemas;

use Filament\Schemas\Schema;

class CourseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                    // LEFT COLUMN (Main Info)
                    \Filament\Schemas\Components\Group::make()
                        ->schema([
                            \Filament\Schemas\Components\Section::make('Thông tin danh mục')
                                ->schema([
                                    \Filament\Schemas\Components\Grid::make([
                                        'default' => 1,
                                        'lg' => 12,
                                    ])->schema([
                                        \Filament\Forms\Components\TextInput::make('name')
                                            ->label('Tên danh mục')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                                            ->columnSpan([
                                                'default' => 12,
                                                'lg' => 6,
                                            ]),

                                        \Filament\Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->disabled()
                                            ->dehydrated()
                                            ->columnSpan([
                                                'default' => 12,
                                                'lg' => 6,
                                            ]),

                                        \Filament\Forms\Components\Textarea::make('description')
                                            ->label('Mô tả')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                                ]),
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 8,
                        ]),

                    // RIGHT COLUMN (Settings)
                    \Filament\Schemas\Components\Group::make()
                        ->schema([
                            \Filament\Schemas\Components\Section::make('Cài đặt')
                                ->schema([
                                    \Filament\Forms\Components\Toggle::make('is_active')
                                        ->label('Hiển thị')
                                        ->helperText('Danh mục này sẽ hiển thị trên website')
                                        ->default(true)
                                        ->inline(false),
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
