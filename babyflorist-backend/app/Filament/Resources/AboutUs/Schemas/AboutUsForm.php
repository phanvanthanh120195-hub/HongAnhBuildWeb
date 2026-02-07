<?php

namespace App\Filament\Resources\AboutUs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutUsForm
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
                                    Section::make('Hình ảnh đại diện')
                                        ->schema([
                                            FileUpload::make('image')
                                                ->label('Ảnh về chúng tôi')
                                                ->image()
                                                ->imageEditor()
                                                ->directory('about-us')
                                                ->columnSpanFull(),
                                        ]),
                                    Section::make('Thông tin giới thiệu')
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Tiêu đề / Tên')
                                                ->maxLength(255)
                                                ->required()
                                                ->columnSpanFull(),
                                            RichEditor::make('description')
                                                ->label('Mô tả về chúng tôi')
                                                ->columnSpanFull()
                                                ->extraInputAttributes([
                                                    'style' => 'min-height: 200px;',
                                                ]),
                                        ]),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 8,
                                ]),

                            // RIGHT COLUMN (Image)
                            Group::make()
                                ->schema([
                                    Section::make('Trạng thái')
                                        ->schema([
                                            \Filament\Forms\Components\Toggle::make('is_active')
                                                ->label('Hiển thị')
                                                ->default(true),
                                        ]),
                                    Section::make('Liên hệ mạng xã hội')
                                        ->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'lg' => 2,
                                            ])->schema([
                                                        TextInput::make('facebook')
                                                            ->label('Facebook')
                                                            ->url()
                                                            ->placeholder('https://facebook.com/yourpage')
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 8,
                                                            ]),

                                                        TextInput::make('instagram')
                                                            ->label('Instagram')
                                                            ->url()
                                                            ->placeholder('https://instagram.com/yourpage')
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 8,
                                                            ]),
                                                    ]),
                                        ]),
                                    Section::make('Thông tin liên hệ')
                                        ->schema([
                                            Grid::make([
                                                'default' => 1,
                                                'lg' => 2,
                                            ])->schema([
                                                        TextInput::make('phone')
                                                            ->label('Số điện thoại')
                                                            ->tel()
                                                            ->placeholder('0123 456 789')
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 8,
                                                            ]),

                                                        TextInput::make('zalo')
                                                            ->label('Zalo')
                                                            ->placeholder('Số Zalo hoặc link Zalo')
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 8,
                                                            ]),

                                                        TextInput::make('email')
                                                            ->label('Email')
                                                            ->email()
                                                            ->placeholder('contact@yourshop.com')
                                                            ->columnSpan([
                                                                'default' => 12,
                                                                'lg' => 8,
                                                            ]),
                                                    ]),
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
