<?php

namespace App\Filament\Resources\SupportRequest\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupportRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin liên hệ')
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Họ tên')
                                    ->disabled()
                                    ->required(),
                                TextInput::make('phone')
                                    ->label('SĐT')
                                    ->disabled()
                                    ->required(),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->disabled()
                                    ->required(),
                                TextInput::make('subject')
                                    ->label('Chủ đề')
                                    ->disabled()
                                    ->required(),
                            ]),
                        Section::make('Nội dung')
                            ->schema([
                                Textarea::make('message')
                                    ->label('Nội dung đầy đủ')
                                    ->disabled()
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Xử lý')
                            ->schema([
                                Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'new' => 'Mới',
                                        'processing' => 'Đang xử lý',
                                        'done' => 'Hoàn thành',
                                        'spam' => 'Spam',
                                    ])
                                    ->required()
                                    ->default('new'),
                                Textarea::make('internal_note')
                                    ->label('Ghi chú nội bộ')
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
