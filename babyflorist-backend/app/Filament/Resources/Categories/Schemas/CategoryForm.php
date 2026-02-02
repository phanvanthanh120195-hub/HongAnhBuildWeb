<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make([
                'default' => 1,
                'lg' => 12,
            ])->schema([

                // LEFT COLUMN (8/12)
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
                                        ->unique(ignoreRecord: true)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(
                                            fn (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) =>
                                                $operation === 'create'
                                                    ? $set('slug', Str::slug($state))
                                                    : null
                                        )
                                        ->columnSpan([
                                            'default' => 12,
                                            'lg' => 6,
                                        ]),

                                    TextInput::make('slug')
                                        ->label('Đường dẫn (Slug)')
                                        ->disabled()
                                        ->dehydrated()
                                        ->columnSpan([
                                            'default' => 12,
                                            'lg' => 6,
                                        ]),
                                    Textarea::make('description')
                                        ->label('Mô tả')
                                        ->rows(3)   
                                        ->columnSpan([
                                            'default' => 12,
                                            'lg' => 12,
                                        ])
                                        ->required(false)
                                ]),
                            ]),
                    ])
                    ->columnSpan([
                        'default' => 12,
                        'lg' => 8,
                    ]),

                // RIGHT SIDEBAR (4/12)
                Group::make()
                    ->schema([
                        Section::make('Cài đặt')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Hiển thị')
                                    ->helperText('Danh mục này sẽ hiển thị trên website')
                                    ->default(true)
                                    ->inline(false),

                                TextInput::make('sort_order')
                                    ->label('Thứ tự sắp xếp')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Số nhỏ hơn sẽ hiển thị trước'),
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
