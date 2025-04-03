<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Redis;

class BlogPostsChartWeekly extends ChartWidget
{
    protected static ?string $heading = 'Views Berita Harian';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $days = 7; // Misalnya 7 hari terakhir
        $labels = [];
        $viewsData = [];

        // Mulai dari hari 6 hari yang lalu hingga hari ini
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = $date;
            // Jika key tidak ada, maka default ke 0
            $viewsData[] = (int) Redis::get("blog:views:daily:{$date}") ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Views per Hari',
                    'data' => $viewsData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
