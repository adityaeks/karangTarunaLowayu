@extends('layouts.app')
@section('content')
    @php
        $slider = App\Models\Slider::latest()->first();
        $news = App\Models\Berita::latest()->get();
        $sliderImages = App\Models\Slider::latest()->take(5)->get();

        // Data dummy pertandingan Sepak Bola
        $sepakBolaMatches = [
            ['team1' => 'RT 04', 'team2' => 'RT 05', 'score' => '0 - 0', 'date' => '2025-07-14', 'time' => '15:25'],
            ['team1' => 'RT 16', 'team2' => 'RT 08', 'score' => '0 - 0', 'date' => '2025-07-14', 'time' => '16:15'],
            ['team1' => 'RT 16', 'team2' => 'RT 06', 'score' => '2 - 2', 'date' => '2025-07-15', 'time' => '15:25'],
            ['team1' => 'RT 05', 'team2' => 'RT 06', 'score' => '2 - 2', 'date' => '2025-07-15', 'time' => '16:15'],
        ];
        $sepakBolaGrouped = collect($sepakBolaMatches)->groupBy('date');

        // Data dummy pertandingan Bola Voli
        $voliMatches = [
            ['team1' => 'RT 07', 'team2' => 'RT 04', 'score' => '0 - 0', 'date' => '2025-08-06', 'time' => '15:25'],
            ['team1' => 'RT 09', 'team2' => 'RT 29', 'score' => '0 - 0', 'date' => '2025-08-06', 'time' => '16:15'],
            // ['team1' => 'RT 03', 'team2' => 'RT 04', 'score' => '0 - 0', 'date' => '2025-07-18', 'time' => '16:30'],
            // ['team1' => 'RT 03', 'team2' => 'RT 04', 'score' => '0 - 0', 'date' => '2025-07-18', 'time' => '16:30'],
        ];
        $voliGrouped = collect($voliMatches)->groupBy('date');

        use Carbon\Carbon;
        $today = Carbon::today()->toDateString();
        function getActiveDate($grouped, $today)
        {
            $dates = $grouped->keys()->sort()->values();
            if ($dates->contains($today)) {
                return $today;
            }
            foreach ($dates as $date) {
                if ($date > $today) {
                    return $date;
                }
            }
            return $dates->last();
        }
        $sepakBolaActiveDate = getActiveDate($sepakBolaGrouped, $today);
        $voliActiveDate = getActiveDate($voliGrouped, $today);
    @endphp
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row align-items-start">
                    <div class="col-lg-8">
                        <!-- Head Topic -->
                        <div class="trending-top mb-30 position-relative mt-20">
                            <div class="trending2-wrapper">
                                @if ($sliderImages->count() > 0)
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($sliderImages as $index => $image)
                                                <li data-target="#carouselExampleIndicators"
                                                    data-slide-to="{{ $index }}"
                                                    class="{{ $index == 0 ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($sliderImages as $index => $image)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('uploads/' . $image->photo) }}" class="d-block w-100"
                                                        style="height: 500px; object-fit: cover;" alt="Slider Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                @else
                                    <p>No slider images available.</p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-lg-4 mt-20">
                        <div class="text-center mb-15">
                            <span
                                style="
                                font-weight: 900;
                                font-size: 25px;
                                letter-spacing: 2px;
                                color: #ba2d11;
                                text-transform: uppercase;
                                text-shadow: 1px 1px 2px #eee;
                                border-bottom: 2px solid #ba2d11;
                                padding-bottom: 3px;
                                display: inline-block;">
                                Spesial Agustus
                            </span>
                        </div>
                        <!-- Card Sepak Bola (Desain Mirip Gambar, Jam di Bawah) -->
                        <div class="card mb-3 shadow-sm mt-0" style="border-radius: 8px; border: 1.5px solid #eee;">
                            <div class="p-3" style="background: #fff; border-bottom: 1.5px solid #eee;">
                                <div class="text-center">
                                    <span
                                        style="
                                        font-weight: 900;
                                        font-size: 18px;
                                        letter-spacing: 2px;
                                        color: #ba2d11;
                                        text-transform: uppercase;
                                        text-shadow: 1px 1px 2px #eee;
                                        /* border-bottom: 2px solid #ba2d11; */
                                        padding-bottom: 3px;
                                        display: inline-block;">
                                        ⚽ SEPAK BOLA
                                    </span>
                                </div>
                            </div>
                            <div id="sepakBolaCarousel" class="carousel slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach ($sepakBolaGrouped as $date => $matches)
                                        <div class="carousel-item {{ $date == $sepakBolaActiveDate ? 'active' : '' }}">
                                            @foreach ($matches as $i => $match)
                                                <div
                                                    style="background: {{ $i == 0 ? '#f7f7f7' : '#fff' }}; border-bottom: 1.5px solid #eee; padding: 6px 16px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                                        style="gap: 8px;">
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: right; font-weight:700; color:#222; font-size:15px;">
                                                            {{ $match['team1'] }}
                                                        </span>
                                                        <span class="score-box"
                                                            style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-weight: bold; padding: 2px 12px; border-radius: 6px; font-size: 15px; box-shadow: 0 2px 8px rgba(186,45,17,0.08); letter-spacing: 2px;">
                                                            {{ $match['score'] }}
                                                        </span>
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: left; font-weight:700; color:#222; font-size:15px;">
                                                            {{ $match['team2'] }}
                                                        </span>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="d-inline-block"
                                                            style="font-size:10px; color:#555; background: #fff3e0; padding: 1px 8px 1px 6px; border-radius: 8px; font-weight: bold;">
                                                            <i class="fa fa-clock-o" style="margin-right:3px;"></i>
                                                            {{ \Carbon\Carbon::parse($match['date'])->format('d M Y') }} •
                                                            {{ $match['time'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#sepakBolaCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Sebelumnya</span>
                                </a>
                                <a class="carousel-control-next" href="#sepakBolaCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Selanjutnya</span>
                                </a>
                            </div>
                        </div>
                        <!-- Card Bola voli (Desain Mirip Gambar, Jam di Bawah) -->
                        <div class="card mb-3 shadow-sm mt-0" style="border-radius: 8px; border: 1.5px solid #eee;">
                            <div class="p-3" style="background: #fff; border-bottom: 1.5px solid #eee;">
                                <div class="text-center">
                                    <span
                                        style="
                                        font-weight: 900;
                                        font-size: 18px;
                                        letter-spacing: 2px;
                                        color: #ba2d11;
                                        text-transform: uppercase;
                                        text-shadow: 1px 1px 2px #eee;
                                        /* border-bottom: 2px solid #ba2d11; */
                                        padding-bottom: 3px;
                                        display: inline-block;">
                                        🏐 BOLA VOLI
                                    </span>
                                </div>
                            </div>
                            <div id="voliCarousel" class="carousel slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach ($voliGrouped as $date => $matches)
                                        <div class="carousel-item {{ $date == $voliActiveDate ? 'active' : '' }}">
                                            @foreach ($matches as $i => $match)
                                                <div
                                                    style="background: {{ $i == 0 ? '#f7f7f7' : '#fff' }}; border-bottom: 1.5px solid #eee; padding: 6px 16px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                                        style="gap: 8px;">
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: right; font-weight:700; color:#222; font-size:15px;">
                                                            {{ $match['team1'] }}
                                                        </span>
                                                        <span class="score-box"
                                                            style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-weight: bold; padding: 2px 12px; border-radius: 6px; font-size: 15px; box-shadow: 0 2px 8px rgba(186,45,17,0.08); letter-spacing: 2px;">
                                                            {{ $match['score'] }}
                                                        </span>
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: left; font-weight:700; color:#222; font-size:15px;">
                                                            {{ $match['team2'] }}
                                                        </span>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="d-inline-block"
                                                            style="font-size:10px; color:#555; background: #fff3e0; padding: 1px 8px 1px 6px; border-radius: 8px; font-weight: bold;">
                                                            <i class="fa fa-clock-o" style="margin-right:3px;"></i>
                                                            {{ \Carbon\Carbon::parse($match['date'])->format('d M Y') }} •
                                                            {{ $match['time'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#voliCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Sebelumnya</span>
                                </a>
                                <a class="carousel-control-next" href="#voliCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Selanjutnya</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <!-- Advertisement Banner -->
    <div class="advertisement-banner text-center my-4" style="padding: 0 15px;">
        <a href="https://api.whatsapp.com/send/?phone=%2B6285183260964&text&type=phone_number&app_absent=0"
            target="_blank">
            <img src="{{ asset('assets/img/iklan-sponsor2.jpg') }}" class="img-fluid ad-responsive" alt="Iklan Sponsor">
        </a>
    </div>


    {{-- Iklan Banner disini --}}

    {{-- Kategori Sosial --}}
    <div class="weekly2-news-area weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- Section Title -->
                @php
                    $weeklyNews = App\Models\Berita::where('category_id', 2)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30 d-flex justify-content-between align-items-center">
                            <h3>Sosial</h3>
                            <a href="{{ url('/blog?category=2') }}" class="more-news-link">More news...</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($weeklyNews->count() > 0)
                        @foreach ($weeklyNews->take(4) as $newsItem)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                    <div class="single-recent mb-30">
                                        <div class="what-img">
                                            <img src="{{ asset('uploads/' . $newsItem->photo) }}" alt=""
                                                class="img-fluid card-img-top"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="body-cap card-body">
                                            <span class="color1"
                                                style="margin-top: -10px;">{{ $newsItem->created_at->format('d M Y') }}</span>
                                            <h4 class="card-title text-dark hover-text">
                                                {{ Str::limit($newsItem->name, 50) }}
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <p class="text-center text-muted">No news available in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Kategori Kemasyarakatan --}}
    <div class="weekly2-news-area weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- Section Title -->
                @php
                    $weeklyNews = App\Models\Berita::where('category_id', 4)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30 d-flex justify-content-between align-items-center">
                            <h3>Kemasyarakatan</h3>
                            <a href="{{ url('/blog?category=4') }}" class="more-news-link">More news...</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($weeklyNews->count() > 0)
                        @foreach ($weeklyNews->take(4) as $newsItem)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                    <div class="single-recent mb-30">
                                        <div class="what-img">
                                            <img src="{{ asset('uploads/' . $newsItem->photo) }}" alt=""
                                                class="img-fluid card-img-top"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="body-cap card-body">
                                            <span class="color1"
                                                style="margin-top: -10px;">{{ $newsItem->created_at->format('d M Y') }}</span>
                                            <h4 class="card-title text-dark hover-text">
                                                {{ Str::limit($newsItem->name, 50) }}
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <p class="text-center text-muted">No news available in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Kategori Agama --}}
    <div class="weekly2-news-area weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- Section Title -->
                @php
                    $weeklyNews = App\Models\Berita::where('category_id', 3)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30 d-flex justify-content-between align-items-center">
                            <h3>Keagamaan</h3>
                            <a href="{{ url('/blog?category=3') }}" class="more-news-link">More news...</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($weeklyNews->count() > 0)
                        @foreach ($weeklyNews->take(4) as $newsItem)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                    <div class="single-recent mb-30">
                                        <div class="what-img">
                                            <img src="{{ asset('uploads/' . $newsItem->photo) }}" alt=""
                                                class="img-fluid card-img-top"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="body-cap card-body">
                                            <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                            <h4 class="card-title text-dark hover-text">
                                                {{ Str::limit($newsItem->name, 50) }}
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <p class="text-center text-muted">No news available in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Kategori Edukasi --}}
    <div class="weekly2-news-area weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- Section Title -->
                @php
                    $weeklyNews = App\Models\Berita::where('category_id', 1)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30 d-flex justify-content-between align-items-center">
                            <h3>Edukasi</h3>
                            <a href="{{ url('/blog?category=1') }}" class="more-news-link">More news...</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($weeklyNews->count() > 0)
                        @foreach ($weeklyNews->take(4) as $newsItem)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                    <div class="single-recent mb-30">
                                        <div class="what-img">
                                            <img src="{{ asset('uploads/' . $newsItem->photo) }}" alt=""
                                                class="img-fluid card-img-top"
                                                style="width: 100%; height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="body-cap card-body">
                                            <span class="color1"
                                                style="margin-top: -10px;">{{ $newsItem->created_at->format('d M Y') }}</span>
                                            <h4 class="card-title text-dark hover-text">
                                                {{ Str::limit($newsItem->name, 50) }}
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <p class="text-center text-muted">No news available in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Popup Modal -->
    {{-- <div class="modal fade" id="popupImageModal" tabindex="-1" role="dialog" aria-labelledby="popupImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content position-relative">
                <!-- Tombol Close "X" -->
                <button type="button" class="close position-absolute" style="top: 10px; right: 15px; z-index: 10;"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                </button>

                <div class="modal-body p-0">
                    <a href="https://galowtunasbangsa.com/Halo!.GALOW.Pengaduan" target="_blank">
                        <img src="{{ asset('assets/img/logo/modal-pengaduan.jpg') }}" alt="Popup"
                            class="img-fluid w-100">
                    </a>
                    <!--<img src="{{ asset('assets/img/logo/logo-utama.jpg') }}" alt="Popup" class="img-fluid w-100">-->
                </div>
            </div>
        </div>
    </div> --}}

    <style>
        .hover-text {
            transition: color 0.3s ease;
        }

        .hover-text:hover {
            color: #e74c3c !important;
        }

        .more-news-link {
            font-size: 14px;
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .more-news-link:hover {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
        }

        .weekly2-news-area {
            padding: 30px 0 !important;
        }

        .weekly2-pading {
            padding: 30px 0 !important;
        }

        /* Hover effect for news items */
        .trand-right-single:hover h4,
        .single-recent:hover h4 {
            color: #e74c3c !important;
        }

        /* Add transition for smooth effect */
        .trand-right-single h4,
        .single-recent h4 {
            transition: color 0.3s ease;
        }

        .single-recent .what-img {
            overflow: hidden;
            /* Menjaga gambar tetap dalam batas kontainer */
        }

        .single-recent .what-img img {
            transition: transform 0.5s ease;
            /* Durasi dan efek transisi */
            transform: scale(1);
            /* Ukuran awal normal */
        }

        .single-recent:hover .what-img img {
            transform: scale(1.1);
            /* Efek zoom saat hover */
        }

        .single-recent {
            border: 1px solid #ddd;
            /* Border di sekeliling card */
            border-bottom: 5px solid red;
            /* Border bawah lebih tebal dengan warna merah */
            border-radius: 5px;
            overflow: hidden;
        }

        .single-recent .card-title {
            font-size: 20px;
            /* Adjusted font size for category names */
        }

        .ad-responsive {
            width: 100%;
            max-width: 1170px;
            /* Match the width of the section above */
            height: auto;
            object-fit: contain;
            margin: 0 auto;
            /* Center the ad */
        }

        /* Jika ingin mempertahankan proporsi tertentu di desktop, bisa gunakan media queries */
        @media (min-width: 768px) {
            .ad-responsive {
                /* Contoh: atur tinggi tetap hanya untuk layar yang lebih besar */
                height: 250px;
                object-fit: cover;
            }
        }

        .hover-card:hover .card-title {
            color: #e74c3c !important;
        }

        @media (max-width: 768px) {
            .carousel-inner img {
                height: 250px !important;
                object-fit: cover;
            }
        }

        /* Styling untuk Hasil Pertandingan */
        .match-result-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e0e0e0 !important;
        }

        .match-result-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .score-box {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .team-name {
            font-size: 12px;
            font-weight: 600;
            color: #2c3e50;
        }

        .tournament-name {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tournament-asean {
            color: #27ae60;
        }

        .tournament-fifa {
            color: #3498db;
        }

        .flag-img {
            width: 30px;
            height: 20px;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Debug CSS untuk memastikan card bola voli terlihat */
        .match-result-card {
            min-height: 200px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Pastikan struktur card tidak terpotong */
        .col-lg-4 {
            position: relative;
            z-index: 1;
        }

        /* Styling khusus untuk card bola voli */
        .volley-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%) !important;
            border: 2px solid #2196f3 !important;
            margin-bottom: 20px !important;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tampilkan modal popup setelah halaman selesai dimuat
            $('#popupImageModal').modal('show');
        });
    </script>

@endsection
