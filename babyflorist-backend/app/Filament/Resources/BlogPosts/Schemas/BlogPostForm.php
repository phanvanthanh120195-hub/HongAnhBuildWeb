<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /**
             * 🔑 GRID NGOÀI CÙNG
             * ÉP cols-lg = 12 để KHÔNG bị Filament auto cols-lg = 2
             */
            Grid::make([
                'default' => 1,
                'lg' => 12,
            ])->schema([

                /* ================= LEFT COLUMN (8/12) ================= */
                Group::make()
                    ->schema([

                        Section::make('Nội dung chính')
                            ->schema([

                                Grid::make([
                                    'default' => 1,
                                    'lg' => 12,
                                ])->schema([

                                    TextInput::make('title')
                                        ->label('Tiêu đề')
                                        ->required()
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
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->columnSpan([
                                            'default' => 12,
                                            'lg' => 6,
                                        ]),
                                ]),

                                RichEditor::make('content')
                                    ->label('Nội dung')
                                    ->required()
                                    ->columnSpanFull()
                                    ->extraInputAttributes([
                                        'style' => 'min-height: 420px;',
                                    ]),
                            ]),

                        Section::make('Hình ảnh')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('blog-thumbnails')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan([
                        'default' => 12,
                        'lg' => 8,
                    ]),

                /* ================= RIGHT SIDEBAR (4/12) ================= */
                Group::make()
                    ->schema([

                        Section::make('Trạng thái')
                            ->schema([
                                Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'published' => 'Đã xuất bản',
                                        'draft' => 'Bản nháp',
                                    ])
                                    ->default('draft')
                                    ->required(),

                                DatePicker::make('published_at')
                                    ->label('Ngày xuất bản')
                                    ->default(now()),
                            ]),

                        Section::make('Phân loại')
                            ->schema([
                                TextInput::make('category')
                                    ->label('Danh mục'),

                                TextInput::make('tags')
                                    ->label('Thẻ (Tags)'),
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
