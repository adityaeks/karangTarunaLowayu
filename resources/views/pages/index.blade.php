@extends('layouts.app')
@section('head')
    <meta name="turbolinks-cache-control" content="no-cache">
    <!-- Force-load modal on page load -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                try {
                    if (jQuery && jQuery('#popupImageModal').length) {
                        jQuery('#popupImageModal').modal('show');
                        console.log('Modal forced to show from head section');
                    }
                } catch (e) {
                    console.error('Error showing modal from head:', e);
                }
            }, 1000);
        });
    </script>
@endsection
@section('meta')
    <title>Galow Tunas Bangsa - Portal Informasi & Berita Desa Lowayu</title>
    <meta name="description" content="Portal informasi, berita, kegiatan, dan komunitas Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu.">
    <meta property="og:title" content="Galow Tunas Bangsa - Portal Informasi & Berita Desa Lowayu" />
    <meta property="og:description" content="Portal informasi, berita, kegiatan, dan komunitas Karang Taruna Lowayu (Galow Tunas Bangsa) Desa Lowayu." />
    <meta property="og:image" content="{{ asset('assets/img/logo/logo-utama.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
@endsection
@section('content')
    @php
        $slider = App\Models\Slider::latest()->first();
        $news = App\Models\Berita::latest()->get();
        $sliderImages = App\Models\Slider::latest()->take(5)->get();

        use App\Models\Match17;
        use Carbon\Carbon;

        $sepakBolaMatches = Match17::where('type', 'sepakbola')->orderBy('date')->orderBy('time')->get();
        $sepakBolaGrouped = $sepakBolaMatches->groupBy('date');

        $voliMatches = Match17::where('type', 'voli')->orderBy('date')->orderBy('time')->get();
        $voliGrouped = $voliMatches->groupBy('date');

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
                            <div id="sepakBolaCarousel" class="carousel slide" data-touch="true">
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
                                                            RT {{ $match['team1'] }}
                                                        </span>
                                                        <span class="score-box"
                                                            style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-weight: bold; padding: 2px 12px; border-radius: 6px; font-size: 15px; box-shadow: 0 2px 8px rgba(186,45,17,0.08); letter-spacing: 2px;">
                                                            {{ $match['score'] }}
                                                        </span>
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: left; font-weight:700; color:#222; font-size:15px;">
                                                            RT {{ $match['team2'] }}
                                                        </span>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="d-inline-block"
                                                            style="font-size:10px; color:#555; background: #fff3e0; padding: 1px 8px 1px 6px; border-radius: 8px; font-weight: bold;">
                                                            <i class="fa fa-clock-o" style="margin-right:3px;"></i>
                                                            {{ \Carbon\Carbon::parse($match['date'])->format('d M Y') }} •
                                                            {{ substr($match['time'], 0, 5) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#sepakBolaCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#sepakBolaCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
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
                            <div id="voliCarousel" class="carousel slide" data-touch="true">
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
                                                            RT {{ $match['team1'] }}
                                                        </span>
                                                        <span class="score-box"
                                                            style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-weight: bold; padding: 2px 12px; border-radius: 6px; font-size: 15px; box-shadow: 0 2px 8px rgba(186,45,17,0.08); letter-spacing: 2px;">
                                                            {{ $match['score'] }}
                                                        </span>
                                                        <span class="team-name"
                                                            style="min-width: 110px; text-align: left; font-weight:700; color:#222; font-size:15px;">
                                                            RT {{ $match['team2'] }}
                                                        </span>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="d-inline-block"
                                                            style="font-size:10px; color:#555; background: #fff3e0; padding: 1px 8px 1px 6px; border-radius: 8px; font-weight: bold;">
                                                            <i class="fa fa-clock-o" style="margin-right:3px;"></i>
                                                            {{ \Carbon\Carbon::parse($match['date'])->format('d M Y') }} •
                                                            {{ substr($match['time'], 0, 5) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#voliCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#voliCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>                        </div>
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

    <!-- Visitor Counter Widget Section -->
    {{-- <div class="weekly2-news-area weekly2-pading">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="border-radius: 8px; border: 1.5px solid #eee;">
                        <div class="p-3" style="background: #fff; border-bottom: 1.5px solid #eee;">
                            <div class="text-center">
                                <span style="font-weight: 900; font-size: 22px; letter-spacing: 2px; color: #ba2d11; text-transform: uppercase; text-shadow: 1px 1px 2px #eee; padding-bottom: 3px; display: inline-block;">
                                    <i class="fas fa-chart-line mr-2"></i> STATISTIK PENGUNJUNG
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center py-4" style="padding: 12px 20px;">
                                    <span class="h5 mb-0"><i class="fas fa-users mr-3" style="color: #ba2d11;"></i> Total Pengunjung</span>
                                    <span id="total-visitors" data-value="0" class="badge badge-pill h5 mb-0" style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-size: 18px; padding: 8px 20px; min-width: 100px;">0</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-4" style="padding: 12px 20px;">
                                    <span class="h5 mb-0"><i class="fas fa-calendar-day mr-3" style="color: #ba2d11;"></i> Hari Ini</span>
                                    <span id="today-visitors" data-value="0" class="badge badge-pill h5 mb-0" style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-size: 18px; padding: 8px 20px; min-width: 100px;">0</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-4" style="padding: 12px 20px;">
                                    <span class="h5 mb-0"><i class="fas fa-signal mr-3" style="color: #ba2d11;"></i> Online</span>
                                    <span id="online-visitors" data-value="0" class="badge badge-pill h5 mb-0" style="background: linear-gradient(135deg, #ba2d11 60%, #e57373 100%); color: #fff; font-size: 18px; padding: 8px 20px; min-width: 100px;">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Popup Modal -->
    <div class="modal fade" id="popupImageModal" tabindex="-1" role="dialog" aria-labelledby="popupImageModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content position-relative">
                <!-- Tombol Close "X" -->
                <button type="button" class="close position-absolute" style="top: 10px; right: 15px; z-index: 10;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                </button>

                <div class="modal-body p-0">
                    <a href="https://galowtunasbangsa.com/Halo!.GALOW.Pengaduan" target="_blank">
                        <img src="{{ asset('assets/img/logo/modal-pengaduan.jpg') }}" alt="Popup" class="img-fluid w-100">
                    </a>
                    <!--<img src="{{ asset('assets/img/logo/logo-utama.jpg') }}" alt="Popup" class="img-fluid w-100">-->
                </div>
            </div>
        </div>
    </div>

    <!-- Dedicated modal script -->
    <script>
        // Immediate self-executing function to show the modal
        (function() {
            // Try to show immediately
            if (typeof jQuery !== 'undefined') {
                jQuery('#popupImageModal').modal('show');
                console.log('Modal show attempt from inline script');
            }

            // Also try with a small delay
            setTimeout(function() {
                if (typeof jQuery !== 'undefined') {
                    // Remove any existing backdrops first
                    jQuery('.modal-backdrop').remove();
                    jQuery('body').removeClass('modal-open');

                    // Then show the modal
                    jQuery('#popupImageModal').modal('show');
                    console.log('Modal show attempt from inline script with delay');
                }
            }, 800);
        })();
    </script>

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

        /* Carousel controls menggunakan styling default Bootstrap */
    </style>
    <script>
        // Bootstrap 4 (jQuery)
        $(function() {
            // Inisialisasi carousels
            $('#sepakBolaCarousel, #voliCarousel').carousel('pause').carousel({interval: false, pause: true, wrap: true});
        });

        // Visitor Counter Functions
        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num;
        }

        function updateVisitorStats() {
            fetch('/api/visitor-stats')
                .then(response => response.json())
                .then(data => {
                    // Update counters with animation
                    animateCounter('total-visitors', data.total);
                    animateCounter('today-visitors', data.today);
                    animateCounter('online-visitors', data.online);
                })
                .catch(error => console.error('Error fetching visitor stats:', error));
        }

        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const currentValue = parseInt(element.getAttribute('data-value') || '0');
            element.setAttribute('data-value', targetValue);

            // If the difference is small, just update without animation
            if (Math.abs(targetValue - currentValue) < 5) {
                element.textContent = formatNumber(targetValue);
                return;
            }

            let startValue = currentValue;
            const duration = 1000;
            const startTime = performance.now();

            function updateCounter(timestamp) {
                const elapsed = timestamp - startTime;
                const progress = Math.min(elapsed / duration, 1);

                const currentCount = Math.floor(startValue + (targetValue - startValue) * progress);
                element.textContent = formatNumber(currentCount);

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = formatNumber(targetValue);
                }
            }

            requestAnimationFrame(updateCounter);
        }

        // Update visitor stats on page load and every 30 seconds
        document.addEventListener('DOMContentLoaded', function() {
            updateVisitorStats();
            setInterval(updateVisitorStats, 30000);

            // Force modal to appear with various methods and debugging
            console.log("DOM Content Loaded - attempting to show modal");

            // Method 1: Standard Bootstrap modal show
            setTimeout(function() {
                try {
                    console.log("Modal element exists:", $('#popupImageModal').length > 0);
                    $('#popupImageModal').modal('show');
                    console.log("Modal show method 1 called");
                } catch (e) {
                    console.error("Error in method 1:", e);
                }
            }, 500);

            // Method 2: Direct jQuery method
            setTimeout(function() {
                try {
                    $('#popupImageModal').modal({
                        show: true,
                        backdrop: 'static'
                    });
                    console.log("Modal show method 2 called");
                } catch (e) {
                    console.error("Error in method 2:", e);
                }
            }, 1000);

            // Method 3: Direct DOM manipulation (last resort)
            setTimeout(function() {
                try {
                    var modal = document.getElementById('popupImageModal');
                    if (modal) {
                        modal.classList.add('show');
                        modal.style.display = 'block';
                        document.body.classList.add('modal-open');

                        // Create backdrop if needed
                        if (!document.querySelector('.modal-backdrop')) {
                            var backdrop = document.createElement('div');
                            backdrop.className = 'modal-backdrop fade show';
                            document.body.appendChild(backdrop);
                        }
                        console.log("Modal show method 3 (direct DOM) called");
                    } else {
                        console.error("Modal element not found");
                    }
                } catch (e) {
                    console.error("Error in method 3:", e);
                }
            }, 1500);
        });

        // Additional fallback using window.onload
        window.onload = function() {
            console.log("Window loaded - attempting modal show");
            setTimeout(function() {
                try {
                    $('#popupImageModal').modal('show');
                    console.log("Modal show from window.onload called");
                } catch (e) {
                    console.error("Error in window.onload modal show:", e);
                }
            }, 1000);
        };

        // One more attempt using a simple timeout
        setTimeout(function() {
            console.log("Final timeout attempt - showing modal");
            try {
                $('#popupImageModal').modal('show');
            } catch (e) {
                console.error("Error in final timeout attempt:", e);
            }
        }, 2000);
    </script>
@endsection
