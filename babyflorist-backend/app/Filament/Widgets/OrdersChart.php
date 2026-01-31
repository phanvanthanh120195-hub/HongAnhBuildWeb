<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrdersChart extends ChartWidget
{
    protected ?string $heading = 'Tổng đơn hàng';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $data = \App\Models\Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $data = array_replace(array_fill(1, 12, 0), $data);

        return [
            'datasets' => [
                [
                    'label' => 'Đơn hàng',
                    'data' => array_values($data),
                    'borderColor' => '#f59e0b', // warning/primary color
                ],
            ],
            'labels' => ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
