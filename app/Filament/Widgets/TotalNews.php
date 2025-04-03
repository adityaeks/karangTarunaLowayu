<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Organisasi;
use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalNews extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Berita', Berita::count()),
            Stat::make('Organisasi', Organisasi::count()),
            Stat::make('Pengaduan', Pengaduan::count()),
        ];
    }
}
