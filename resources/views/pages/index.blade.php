@extends('layouts.app')
@section('content')
    @php
        $slider = App\Models\Slider::latest()->first();
        $news = App\Models\Berita::latest()->get();
        $sliderImages = App\Models\Slider::latest()->take(5)->get();
    @endphp
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
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
                                                    <img src="{{ asset('uploads/' . $image->photo) }}" class="d-block w-100" style="height: 500px; object-fit: cover;"
                                                        alt="Slider Image">
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
                        @if ($news->count() > 0)
                            @foreach ($news->take(5) as $item)
                                <a href="{{ url('/detail/' . $item->slug) }}" class="text-decoration-none d-block">
                                    <div class="card mb-3 hover-card" style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; height: 100px; border-bottom: 2px solid red;">
                                        <div class="row no-gutters d-flex" style="height: 100%; flex-wrap: nowrap;">
                                            <div class="col-4" style="overflow: hidden; height: 100%;">
                                                <img src="{{ asset('uploads/' . $item->photo) }}" alt=""
                                                    class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                                                    <h5 class="card-title text-dark">{{ Str::limit($item->name, 30) }}</h5>
                                                    <p class="card-text">
                                                        <small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p>No news available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <!-- Advertisement Banner -->
    <div class="advertisement-banner text-center my-4" style="padding: 0 15px;">
        @php
            $adBanner = App\Models\Ads::latest()->first();
        @endphp
        @if ($adBanner)
            <img src="{{ asset('uploads/' . $adBanner->photo) }}" alt="{{ $adBanner->title }}"
                class="img-fluid ad-responsive">
        @else
            <p>No advertisement available.</p>
        @endif
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
                            <h3>Agama</h3>
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
    </style>
@endsection
