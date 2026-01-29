<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                    /* ================= LEFT COLUMN (8/12) ================= */
                    Group::make()
                        ->schema([
                            Section::make('Thông tin tài khoản')
                                ->schema([
                                    Grid::make(1) // 1 column per row for Inputs to take full width or 2 if desired
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Tên người dùng')
                                                ->placeholder('Nhập tên người dùng'),

                                            TextInput::make('email')
                                                ->label('Địa chỉ Email')
                                                ->placeholder('Nhập địa chỉ email')
                                                ->unique(ignoreRecord: true)
                                                ->helperText('Email sẽ được sử dụng để đăng nhập')
                                                ->email()
                                                ->required(),

                                            TextInput::make('phone')
                                                ->label('Số điện thoại')
                                                ->tel()
                                                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                ->placeholder('Nhập số điện thoại'),

                                            TextInput::make('password')
                                                    ->label('Mật khẩu')
                                                    ->password()
                                                    ->revealable()
                                                    ->dehydrated(fn ($state) => filled($state))
                                                    ->confirmed()
                                                    ->required(fn (string $operation): bool => $operation === 'create'),

                                            TextInput::make('password_confirmation')
                                                ->label('Xác nhận mật khẩu')
                                                ->password()
                                                ->revealable()
                                                ->dehydrated(false)
                                                ->required(fn (string $operation): bool => $operation === 'create'),
                                        ]),
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
                                    Toggle::make('is_active')
                                        ->label('Kích hoạt')
                                        ->default(true),
                                ]),

                            Section::make('Ảnh đại diện')
                                ->schema([
                                    FileUpload::make('avatar_url')
                                        ->label('Ảnh đại diện')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('avatars')
                                        ->columnSpanFull(),
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
