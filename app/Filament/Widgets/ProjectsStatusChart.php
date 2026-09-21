<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectsStatusChart extends ChartWidget
{
    protected ?string $heading = 'توزيع حالات المشاريع الهندسية';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $statuses = [
            'site_survey' => 'معاينة الموقع',
            'design' => 'التصميم والتخطيط',
            'procurement' => 'تجهيز المواد',
            'installation' => 'التركيب والربط',
            'testing' => 'الفحص والاختبار',
            'commissioning' => 'التشغيل والتسليم',
            'completed' => 'مكتمل بنجاح',
        ];

        $data = [];
        $labels = [];

        foreach ($statuses as $key => $label) {
            $labels[] = $label;
            $data[] = Project::where('status', $key)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'عدد المشاريع',
                    'data' => $data,
                    'backgroundColor' => [
                        '#64748b',
                        '#0284c7',
                        '#d97706',
                        '#f59e0b',
                        '#8b5cf6',
                        '#06b6d4',
                        '#10b981',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
