<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin đơn hàng')
                            ->schema([
                                TextInput::make('order_number')
                                    ->label('Mã đơn hàng')
                                    ->required(),
                                Select::make('order_type')
                                    ->label('Loại đơn hàng')
                                    ->options([
                                        'product' => 'Sản phẩm',
                                        'course' => 'Khóa học',
                                    ])
                                    ->default('product')
                                    ->live()
                                    ->required(),
                                TextInput::make('total_amount')
                                    ->label('Tổng tiền')
                                    ->required()
                                    ->suffix('đ')
                                    ->live(onBlur: true)
                                    ->formatStateUsing(fn($state) => $state ? number_format($state, 0, ',', '.') : null)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                        $discount = (float) str_replace('.', '', $get('discount_amount'));
                                        if ($state) {
                                            $total = (float) str_replace('.', '', $state);
                                            $set('total_amount', number_format($total, 0, ',', '.'));
                                            $set('final_amount', number_format($total - $discount, 0, ',', '.'));
                                        }
                                    })
                                    ->dehydrateStateUsing(fn($state) => (float) str_replace('.', '', $state)),

                                TextInput::make('discount_amount')
                                    ->label('Số tiền giảm')
                                    ->required()
                                    ->default(0)
                                    ->suffix('đ')
                                    ->live(onBlur: true)
                                    ->formatStateUsing(fn($state) => $state ? number_format($state, 0, ',', '.') : '0')
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                        $total = (float) str_replace('.', '', $get('total_amount'));
                                        $discount = $state ? (float) str_replace('.', '', $state) : 0;

                                        $set('discount_amount', number_format($discount, 0, ',', '.'));
                                        $set('final_amount', number_format($total - $discount, 0, ',', '.'));
                                    })
                                    ->dehydrateStateUsing(fn($state) => (float) str_replace('.', '', $state)),

                                TextInput::make('final_amount')
                                    ->label('Thành tiền')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->suffix('đ')
                                    ->formatStateUsing(fn($state) => $state ? number_format($state, 0, ',', '.') : '0')
                                    ->dehydrateStateUsing(fn($state) => (float) str_replace('.', '', $state)),
                                TextInput::make('voucher_code')
                                    ->label('Mã Voucher')
                                    ->default(null),
                            ])->columns(2),

                        Section::make('Chi tiết sản phẩm')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship('items')
                                    ->schema([
                                        TextInput::make('item_name')
                                            ->label('Tên sản phẩm')
                                            ->disabled(),
                                        TextInput::make('quantity')
                                            ->label('Số lượng')
                                            ->numeric()
                                            ->disabled(),
                                        TextInput::make('item_price')
                                            ->label('Đơn giá')
                                            ->disabled()
                                            ->formatStateUsing(fn($state) => $state ? number_format($state, 0, ',', '.') . ' đ' : '0 đ'),
                                        TextInput::make('subtotal')
                                            ->label('Thành tiền')
                                            ->disabled()
                                            ->formatStateUsing(fn($state) => $state ? number_format($state, 0, ',', '.') . ' đ' : '0 đ'),
                                    ])
                                    ->columns(4)
                                    ->deletable(false)
                                    ->addable(false)
                                    ->reorderable(false)
                                    ->columnSpanFull(),
                            ])
                            ->hidden(fn($get) => $get('order_type') !== 'product')
                            ->collapsible(),

                        Section::make('Thông tin đăng ký')
                            ->schema([
                                TextInput::make('shipping_name')
                                    ->label('Tên người nhận')
                                    ->required(),
                                TextInput::make('shipping_phone')
                                    ->label('Số điện thoại')
                                    ->tel()
                                    ->required(),
                                Textarea::make('shipping_address')
                                    ->label('Địa chỉ giao hàng')
                                    ->required(fn ($get) => $get('order_type') !== 'course')
                                    ->hidden(fn ($get) => $get('order_type') === 'course')
                                    ->columnSpanFull(),
                                Textarea::make('notes')
                                    ->label('Ghi chú')
                                    ->default(null)
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Trạng thái đơn hàng')
                            ->schema([
                                Select::make('order_status')
                                    ->label('Trạng thái đơn hàng')
                                    ->options(fn (Get $get): array => match ($get('order_type')) {
                                        'course' => [
                                            'pending' => 'Chờ xử lý',
                                            'completed' => 'Hoàn thành',
                                            'cancelled' => 'Đã hủy',
                                        ],
                                        default => [
                                            'pending' => 'Chờ xử lý',
                                            'preparing' => 'Đang chuẩn bị',
                                            'shipping' => 'Đang giao hàng',
                                            'completed' => 'Hoàn thành',
                                            'cancelled' => 'Đã hủy',
                                        ],
                                    })
                                    ->default('pending')
                                    ->required(),
                                
                            ]),

                        Section::make('Thanh thái thanh toán')
                            ->schema([
                                Select::make('payment_status')
                                    ->label('Trạng thái thanh toán')
                                    ->options([
                                        'pending' => 'Chờ xử lý',
                                        'paid' => 'Đã thanh toán',
                                        'failed' => 'Đã hủy',
                                        'refunded' => 'Hoàn tiền',
                                    ])
                                    ->default('pending')
                                    ->required(),
                            ]),
                        Section::make('Thanh toán')
                            ->schema([
                                Select::make('payment_method')
                                    ->label('Phương thức thanh toán')
                                    ->options([
                                        'qr_code' => 'Chuyển khoản QR',
                                        'cod' => 'Thanh toán khi nhận hàng (COD)'
                                    ])
                                    ->default('qr_code')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
