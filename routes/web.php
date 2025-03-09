<?php

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\Organisasi;
use App\Http\Controllers\PengaduanController;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/berita', function () {
    $news = Berita::latest()->paginate(5);
    return view('pages.blog', compact('news'));
});

Route::get('/detail/{id}', function ($id) {
    $news = Berita::findOrFail($id);
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
    return view('pages.blog', compact('news'));
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
});
// Ganti route pengaduan menjadi:
Route::get('/pengaduan', function () {
    return view('pages.complaint');
})->name('pengaduan.form'); // Tambahkan nama route

// Route::post('/pengaduan/store', [PengaduanController::class, 'store'])
//     ->name('pengaduan.store');

Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
