<?php

namespace App\Filament\Resources\Vouchers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;

class VoucherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                    // LEFT COLUMN
                    Group::make()
                        ->schema([
                            Section::make('Thông tin mã giảm giá')
                                ->schema([
                                    TextInput::make('code')
                                        ->label('Mã giảm giá')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull()
                                        ->suffixAction(
                                            Action::make('random')
                                                ->icon('heroicon-m-arrow-path')
                                                ->tooltip('Tạo mã ngẫu nhiên')
                                                ->action(function (Set $set) {
                                                    $set('code', Str::upper(Str::random(10)));
                                                })
                                        ),
                                    
                                    TextInput::make('discount_percentage')
                                            ->label('% Giảm giá')
                                            ->required()
                                            ->numeric()
                                            ->suffix('%'),
                                            
                                    Select::make('apply_to')
                                        ->label('Áp dụng cho')
                                        ->options([
                                            'all_orders' => 'Tất cả đơn hàng',
                                            'product' => 'Sản phẩm', 
                                            'category' => 'Danh mục'
                                        ]) // User originally had product/course, but I'll update/keep typical e-commerce options or keep user's. 
                                        // User's original code: ['product' => 'Product', 'course' => 'Course']
                                        // I will stick to user's original keys but translate values if possible, or keep as is.
                                        // Wait, user said "giữ nguyên các input". 
                                        // So I should keep keys/values but maybe add label.
                                        ->options([
                                            'product' => 'Product', 
                                            'course' => 'Course'
                                        ])
                                        ->required(),

                                    Grid::make(2)->schema([
                                        DatePicker::make('valid_from')
                                            ->label('Hiệu lực từ')
                                            ->required()
                                            ->live(),
                                        DatePicker::make('valid_to')
                                            ->label('Hiệu lực đến')
                                            ->required()
                                            ->minDate(fn (Get $get) => $get('valid_from'))
                                            ->afterOrEqual('valid_from'),
                                    ]),
                                    
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

                    // RIGHT COLUMN
                    Group::make()
                        ->schema([
                            Section::make('Cài đặt')
                                ->schema([
                                    Toggle::make('is_active')
                                        ->label('Hoạt động')
                                        ->default(true),

                                    TextInput::make('usage_limit')
                                        ->label('Giới hạn sử dụng')
                                        ->numeric()
                                        ->default(null),

                                    TextInput::make('used_count')
                                        ->label('Đã sử dụng')
                                        ->required()
                                        ->numeric()
                                        ->default(0),
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
