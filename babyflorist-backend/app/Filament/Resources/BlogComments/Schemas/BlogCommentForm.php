<?php

namespace App\Filament\Resources\BlogComments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BlogCommentForm
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
                                    Section::make('Thông tin bình luận')
                                        ->schema([
                                            Select::make('blog_post_id')
                                                ->label('Bài viết')
                                                ->relationship('blogPost', 'title')
                                                ->searchable()
                                                ->preload()
                                                ->required(),

                                            Select::make('customer_id')
                                                ->label('Người bình luận')
                                                ->relationship('customer', 'name')
                                                ->searchable()
                                                ->preload()
                                                ->required(),

                                            Select::make('parent_id')
                                                ->label('Trả lời bình luận')
                                                ->relationship('parent', 'content', fn($query) => $query->limit(50))
                                                ->searchable()
                                                ->preload()
                                                ->helperText('Để trống nếu là bình luận gốc'),

                                            Textarea::make('content')
                                                ->label('Nội dung')
                                                ->rows(4)
                                                ->required()
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
                                            Toggle::make('is_approved')
                                                ->label('Đã duyệt')
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
