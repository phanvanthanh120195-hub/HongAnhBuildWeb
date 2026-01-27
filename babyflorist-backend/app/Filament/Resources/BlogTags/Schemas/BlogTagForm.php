<?php

namespace App\Filament\Resources\BlogTags\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class BlogTagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                    Group::make()
                        ->schema([
                            Section::make('Thông tin tag')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Tên Tag')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->unique(ignoreRecord: true)
                                        ->afterStateUpdated(fn (Set $set, ?string $state) => $state ? $set('slug', Str::slug($state)) : null),
                                    TextInput::make('slug')
                                        ->label('Slug')
                                        ->required()
                                        ->disabled()
                                        ->dehydrated(),
                                    Textarea::make('description')
                                        ->label('Mô tả')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 8,
                        ]),

                    Group::make()
                        ->schema([
                            Section::make('Cài đặt')
                                ->schema([
                                    Toggle::make('is_active')
                                        ->label('Hiển thị')
                                        ->default(true),
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
