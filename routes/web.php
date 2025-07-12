<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\Organisasi;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\VisitorController;
use App\Models\Category;
use Filament\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Response;


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

Route::get('/detail/{slug}', [BeritaController::class, 'show'])->name('blog.detail');

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
Route::get('/halo.galow.pengaduan', function () {
    return view('pages.complaint');
})->name('pengaduan.form');

// Route::post('/pengaduan/store', [PengaduanController::class, 'store'])
//     ->name('pengaduan.store');

Route::post('/halo.galow.pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');


Route::get('/test-mail', function () {
    Mail::to('penerima@contoh.com')->send(new TestMail);
    return '✔️ Email berhasil dikirim!';
});

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/blog'))
        ->add(Url::create('/about'))
        ->add(Url::create('/organisasi'))
        ->add(Url::create('/structur'))
        ->add(...Berita::all()->map(function ($berita) {
            return Url::create('/detail/' . $berita->slug)
                ->setLastModificationDate($berita->updated_at);
        })->toArray());

    return $sitemap->toResponse(request());
});

Route::get('/news-sitemap.xml', function () {
    $beritaTerbaru = Berita::where('created_at', '>=', now()->subDays(2))->get();


    return response()->view('sitemap.news', [
        'beritas' => $beritaTerbaru,
    ])->header('Content-Type', 'application/xml');
});

// API endpoint untuk statistik pengunjung
Route::get('/api/visitor-stats', [VisitorController::class, 'getStatistics']);
