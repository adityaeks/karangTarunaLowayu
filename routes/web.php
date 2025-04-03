<?php

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\Organisasi;
use App\Http\Controllers\PengaduanController;
use App\Models\Category;
use Filament\Http\Controllers\DashboardController;

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
    $totalNewsCount = Berita::count(); // Calculate total count of all news items

    return view('pages.blog', compact('news', 'categories', 'totalNewsCount'));
});

Route::get('/detail/{slug}', [\App\Http\Controllers\BeritaController::class, 'show'])->name('blog.detail');

Route::get('/search', function () {
    $query = request('query');
    $category = request('category');

    $newsQuery = Berita::query();

    if ($query) {
        $newsQuery->where(function ($q) use ($query) {
            $q->where('slug', 'LIKE', "%{$query}%")
                ->orWhere('name', 'LIKE', "%{$query}%")
                ->orWhereHas('author', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                });
        });
    }

    if ($category) {
        $newsQuery->where('category_id', $category);
    }

    $news = $newsQuery->paginate(10);
    $categories = Category::all();
    $totalNewsCount = Berita::count(); // Calculate total count of all news items

    return view('pages.blog', compact('news', 'categories', 'totalNewsCount'));
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
