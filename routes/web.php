<?php

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\Organisasi;
use App\Http\Controllers\PengaduanController;
use App\Models\Category;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/blog', function () {
    $query = Berita::query();

    if (request('category')) {
        $query->where('category_id', request('category'));
    }

    $news = $query->latest()->paginate(9);
    $categories = Category::all();

    return view('pages.blog', compact('news', 'categories'));
});

Route::get('/detail/{slug}', function ($slug) {
    $news = Berita::where('slug', $slug)->firstOrFail();
    return view('pages.blog-detail', compact('news'));
});

Route::get('/search', function () {
    $query = request('query');
    if ($query) {
        $news = Berita::where('slug', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->paginate(10);
    } else {
        $news = Berita::latest()->paginate(5);
    }
    $categories = Category::all();
    return view('pages.blog', compact('news', 'categories'));
});

Route::get('/about', function () {
    return view('pages.about');
});
// Route::get('/program', function () {
//     return view('pages.program');
// });
Route::get('/structur', function () {
    return view('pages.structur');
});
Route::get('/organisasi', function () {
    $organisasis = Organisasi::all();
    return view('pages.organitation', compact('organisasis'));
});
Route::get('/pengaduan', function () {
    return view('pages.complaint');
})->name('pengaduan.form');

// Route::post('/pengaduan/store', [PengaduanController::class, 'store'])
//     ->name('pengaduan.store');

Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
