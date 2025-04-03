<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BeritaController extends Controller
{
    //
    public function show($slug)
    {
        $news = berita::where('slug', $slug)->with('category', 'author')->firstOrFail();

        // Fetch related news from the same category
        $relatedNews = berita::where('category_id', $news->category_id)
                            ->where('id', '!=', $news->id)
                            ->latest()
                            ->take(5)
                            ->get();

        // Increment views in Redis
        $viewsKey = "blog:views:{$news->id}";
        $views = Redis::incr($viewsKey);

        return view('pages.blog-detail', compact('news', 'views', 'relatedNews'));
    }

}
