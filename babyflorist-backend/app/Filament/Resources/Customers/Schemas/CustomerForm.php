<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin cá nhân')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Họ và tên')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('phone')
                                    ->label('Số điện thoại')
                                    ->tel()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                TextInput::make('password')
                                    ->label('Mật khẩu')
                                    ->password()
                                    ->revealable()
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        
                        Section::make('Địa chỉ nhận hàng')
                             ->schema([
                                 \Filament\Forms\Components\Select::make('province')
                                     ->label('Tỉnh/Thành phố')
                                     ->options(fn () => (new \App\Services\AddressService)->getProvinces())
                                     ->live()
                                     ->searchable()
                                     ->afterStateUpdated(fn ($set) => $set('district', null)),

                                 \Filament\Forms\Components\Select::make('district')
                                     ->label('Quận/Huyện')
                                     ->options(fn ($get) => (new \App\Services\AddressService)->getDistricts($get('province')))
                                     ->live()
                                     ->searchable()
                                     ->disabled(fn ($get) => !$get('province'))
                                     ->afterStateUpdated(fn ($set) => $set('ward', null)),

                                 \Filament\Forms\Components\Select::make('ward')
                                     ->label('Phường/Xã')
                                     ->options(fn ($get) => (new \App\Services\AddressService)->getWards($get('district')))
                                     ->searchable()
                                     ->disabled(fn ($get) => !$get('district')),

                                 Textarea::make('address')
                                     ->label('Địa chỉ cụ thể')
                                     ->rows(3)
                                     ->columnSpanFull(),
                             ])->columns(3),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Ảnh đại diện')
                            ->schema([
                                FileUpload::make('avatar')
                                    ->label('Avatar')
                                    ->image()
                                    ->directory('customers')
                                    ->avatar(),
                            ]),
                        Section::make('Trạng thái')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Kích hoạt')
                                    ->default(true),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
