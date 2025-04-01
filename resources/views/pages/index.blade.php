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
                        <!-- Trending Top -->
                        <div class="trending-top mb-30 position-relative">
                            <div class="trending2-wrapper">
                                @if ($sliderImages->count() > 0)
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($sliderImages as $index => $image)
                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($sliderImages as $index => $image)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->photo) }}" class="d-block w-100" alt="Slider Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
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
                    <div class="col-lg-4">
                        @if ($news->count() > 0)
                            @foreach ($news->take(4) as $item)
                                <a href="{{ url('/detail/' . $item->slug) }}" class="text-decoration-none d-block">
                                    <div class="trand-right-single d-flex mb-3">
                                        <div class="trand-right-img" style="width: 180px; height: 100px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="img-fluid"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="trand-right-cap" style="flex: 1; margin-left: 15px;">
                                            <h4 class="text-dark hover-text">{{ Str::limit($item->name, 30) }}</h4>
                                            <span class="color1">{{ $item->created_at->format('d/m/Y') }}</span>
                                            <p class="small text-muted mt-1">{{ Str::limit(strip_tags($item->content), 30) }}</p>
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
                    @foreach ($weeklyNews->take(4) as $newsItem)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                <div class="single-recent mb-30">
                                    <div class="what-img">
                                        <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="" class="img-fluid card-img-top"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="body-cap card-body">
                                        <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                        <h4 class="card-title text-dark hover-text">{{ Str::limit($newsItem->name, 40) }}</h4>
                                        <p class="text-muted small">{{ Str::limit(strip_tags($newsItem->content), 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                    @foreach ($weeklyNews->take(4) as $newsItem)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                <div class="single-recent mb-30">
                                    <div class="what-img">
                                        <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="" class="img-fluid card-img-top"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="body-cap card-body">
                                        <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                        <h4 class="card-title text-dark hover-text">{{ Str::limit($newsItem->name, 40) }}</h4>
                                        <p class="text-muted small">{{ Str::limit(strip_tags($newsItem->content), 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                    @foreach ($weeklyNews->take(4) as $newsItem)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                <div class="single-recent mb-30">
                                    <div class="what-img">
                                        <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="" class="img-fluid card-img-top"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="body-cap card-body">
                                        <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                        <h4 class="card-title text-dark hover-text">{{ Str::limit($newsItem->name, 40) }}</h4>
                                        <p class="text-muted small">{{ Str::limit(strip_tags($newsItem->content), 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                    @foreach ($weeklyNews->take(4) as $newsItem)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ url('/detail/' . $newsItem->slug) }}" class="text-decoration-none d-block">
                                <div class="single-recent mb-30">
                                    <div class="what-img">
                                        <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="" class="img-fluid card-img-top"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="body-cap card-body">
                                        <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                        <h4 class="card-title text-dark hover-text">{{ Str::limit($newsItem->name, 40) }}</h4>
                                        <p class="text-muted small">{{ Str::limit(strip_tags($newsItem->content), 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
    </style>
@endsection
