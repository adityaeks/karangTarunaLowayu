<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BeritaController extends Controller
{
    public function show($slug)
    {
        $news = Berita::where('slug', $slug)->with('category', 'author')->firstOrFail();

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
