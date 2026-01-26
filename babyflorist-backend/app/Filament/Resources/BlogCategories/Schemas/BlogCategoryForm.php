<?php

namespace App\Filament\Resources\BlogCategories\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class BlogCategoryForm
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
                                    Section::make('Thông tin danh mục')
                                        ->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'lg' => 12,
                                            ])->schema([
                                                        TextInput::make('name')
                                                            ->label('Tên danh mục')
                                                            ->required()
                                                            ->live(onBlur: true)
                                                            ->unique(ignoreRecord: true)
                                                            ->afterStateUpdated(fn(Set $set, ?string $state) => $state ? $set('slug', Str::slug($state)) : null)
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 6,
                                                            ]),

                                                        TextInput::make('slug')
                                                            ->label('Đường dẫn (Slug)')
                                                            ->required()
                                                            ->disabled()
                                                            ->dehydrated()
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 6,
                                                            ]),

                                                        Textarea::make('description')
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
                            Group::make()
                                ->schema([
                                    Section::make('Cài đặt')
                                        ->schema([
                                            Toggle::make('is_active')
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
