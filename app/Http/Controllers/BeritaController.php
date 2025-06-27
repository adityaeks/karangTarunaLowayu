<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;


class BeritaController extends Controller
{
    public function show($slug)
    {
            // dd(request()->ip());

        $news = Berita::where('slug', $slug)->with('category', 'author')->firstOrFail();

        // views($news)->record();
        
        // ini yang view per ip
        $ip = request()->ip();
        $cacheKey = 'viewed_'.$news->id.'_by_'.$ip;  // cache key spesifik per berita dan IP
        
        if (!cache()->has($cacheKey)) {
            views($news)->record();
            cache()->put($cacheKey, true, now()->addHour());
        }


        // Ambil berita terkait dari kategori yang sama
        $relatedNews = Berita::where('category_id', $news->category_id)
                            ->where('id', '!=', $news->id)
                            ->latest()
                            ->take(5)
                            ->get();

        // Simpan views per hari secara global
        $today = now()->format('Y-m-d');
        $viewsKey = "blog:views:daily:{$today}";
        // $views = Redis::incr($viewsKey);

        return view('pages.blog-detail', compact('news',  'relatedNews'));
    }

}
