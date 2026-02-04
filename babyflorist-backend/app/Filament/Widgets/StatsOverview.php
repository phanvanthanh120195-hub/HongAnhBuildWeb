<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Doanh thu', number_format(\App\Models\Order::where('payment_status', 'paid')->sum('final_amount'), 0, ',', '.') . ' ₫')
                ->description('Tổng doanh thu từ đơn hàng đã thanh toán')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Tổng đơn hàng', \App\Models\Order::count())
                ->description('Tất cả đơn hàng')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
            Stat::make('Tổng học viên', \App\Models\Customer::count()) // Assuming Customers are Students
                ->description('Số lượng học viên hệ thống')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
        ];
    }
}
