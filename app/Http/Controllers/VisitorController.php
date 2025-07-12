<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function getStatistics()
    {
        // Total pengunjung keseluruhan
        $totalVisitors = Visitor::count();

        // Pengunjung hari ini
        $todayVisitors = Visitor::whereDate('visited_at', Carbon::today())->count();

        // Pengunjung minggu ini
        $weekVisitors = Visitor::whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // Pengunjung bulan ini
        $monthVisitors = Visitor::whereMonth('visited_at', Carbon::now()->month)
            ->whereYear('visited_at', Carbon::now()->year)
            ->count();

        // Pengunjung online (5 menit terakhir)
        $onlineVisitors = Visitor::where('visited_at', '>=', Carbon::now()->subMinutes(5))->count();

        // Halaman paling populer
        $popularPages = Visitor::select('page', DB::raw('count(*) as total'))
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'total' => $totalVisitors,
            'today' => $todayVisitors,
            'week' => $weekVisitors,
            'month' => $monthVisitors,
            'online' => $onlineVisitors,
            'popular_pages' => $popularPages
        ];
    }
}
