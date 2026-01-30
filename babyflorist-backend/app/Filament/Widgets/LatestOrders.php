<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Đơn hàng gần đây';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('order_number')
                    ->label('Mã đơn hàng')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('order_type')
                    ->label('Loại đơn hàng')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'course' => 'Khóa học',
                        'product' => 'Sản phẩm',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'course' => 'info',
                        'product' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('final_amount')
                    ->label('Thành tiền')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . ' đ')
                    ->sortable(),
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
                        'refunded' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}

