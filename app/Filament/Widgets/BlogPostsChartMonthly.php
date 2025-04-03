<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BlogPostsChartMonthly extends ChartWidget
{
    protected static ?string $heading = 'Views Berita Bulanan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $labels = [];
        $viewsData = [];

        // Dapatkan 12 bulan terakhir, termasuk bulan ini
        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        foreach ($period as $date) {
            $month = $date->format('Y-m'); // Contoh: "2025-04"
            $labels[] = $month;
            // Dapatkan semua key untuk bulan tersebut
            $keys = Redis::keys("blog:views:daily:{$month}-*");
            $monthTotal = 0;
            if (!empty($keys)) {
                // Ambil nilai views dari semua key
                $values = Redis::mget($keys);
                $monthTotal = array_sum($values);
            }
            $viewsData[] = $monthTotal;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Views per Bulan',
                    'data' => $viewsData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
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
