<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SalesRevenueChart extends ChartWidget
{
    protected ?string $heading = 'مخطط الإيرادات والتحصيلات الشهرية (SAR)';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));
        $labels = $months->map(fn ($m) => $m->locale('ar')->translatedFormat('F Y'))->toArray();

        $revenueData = $months->map(function ($m) {
            return Payment::whereYear('payment_date', $m->year)
                ->whereMonth('payment_date', $m->month)
                ->sum('amount');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'الإيرادات المحصلة',
                    'data' => $revenueData,
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#d97706',
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
