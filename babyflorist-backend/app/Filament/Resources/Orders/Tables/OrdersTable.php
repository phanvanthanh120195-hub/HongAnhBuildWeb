<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")
                    ->label("ID")
                    ->searchable(),
                TextColumn::make('order_number')
                    ->label('Mã đơn hàng')
                    ->searchable(),
                TextColumn::make('order_type')
                    ->label('Loại đơn hàng')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'product' => 'Sản phẩm',
                        'course' => 'Khóa học',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'product' => 'info',
                        'course' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('shipping_name')
                    ->label('Tên người nhận')
                    ->searchable(),
                TextColumn::make('shipping_phone')
                    ->label('SĐT người nhận')
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('discount_amount')
                    ->label('Giảm giá')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('final_amount')
                    ->label('Thành tiền')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('voucher_code')
                    ->label('Mã Voucher')
                    ->searchable(),
                TextColumn::make('order_status')
                    ->label('Trạng thái đơn')
                    ->badge()
                    ->formatStateUsing(function ($state, $record) {
                        return match ($state) {
                            'pending' => 'Chờ xử lý',
                            'paid' => 'Đã thanh toán',
                            'preparing' => 'Đang chuẩn bị',
                            'shipping' => 'Đang giao hàng',
                            'completed' => 'Hoàn thành',
                            'cancelled' => 'Đã hủy',
                            default => $state,
                        };
                    })
                    ->color(function ($state, $record) {
                        return match ($state) {
                            'pending' => 'danger',
                            'paid' => 'info',
                            'preparing' => 'warning',
                            'shipping' => 'primary',
                            'completed' => 'success',
                            'cancelled' => 'gray',
                            default => 'gray',
                        };
                    }),
                TextColumn::make('payment_status')
                    ->label('Trạng thái thanh toán')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ thanh toán',
                        'paid' => 'Đã thanh toán',
                        'failed' => 'Thất bại',
                        'refunded' => 'Hoàn tiền',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('payment_method')
                    ->label('Thanh toán qua')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'qr_code' => 'Chuyển khoản QR',
                        'cod' => 'Tiền mặt (COD)',
                        'bank' => 'Chuyển khoản',
                        default => $state,
                    })
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Cập nhật cuối')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
