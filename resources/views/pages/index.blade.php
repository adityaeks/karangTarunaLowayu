@extends('layouts.app')
@section('content')
    @php
        $slider = App\Models\Slider::latest()->first();
        $news = App\Models\Berita::all();
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
                                <div class="trand-right-single d-flex mb-3">
                                    <div class="trand-right-img">
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="img-fluid"
                                            style="width: 200px; height: 100px; object-fit: cover;">
                                    </div>
                                    <div class="trand-right-cap">
                                        <h4><a href="{{ url('/detail/' . $item->id) }}">{{ Str::limit($item->name, 30) }}</a></h4>
                                        <span class="color1">{{ $item->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
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

    <!-- Weekly News Area Start -->
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
                            <h3>Berita Populer</h3>
                            <a href="{{ url('/more-news') }}">More news...</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($weeklyNews->take(4) as $newsItem)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-recent mb-30">
                                <div class="what-img">
                                    <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="" class="img-fluid"
                                    style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="body-cap">
                                    <span class="color1">{{ $newsItem->created_at->format('d M Y') }}</span>
                                    <h4><a href="{{ url('/detail/' . $newsItem->id) }}">{{ Str::limit($newsItem->name, 40) }}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Weekly News Area End -->

    <!-- Recent Articles Start -->
    <div class="recent-articles">
        <div class="container">
            <div class="recent-wrapper">
                <!-- Section Title -->
                @php
                    $recentArticles = App\Models\Berita::latest()->take(5)->get();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Recent Articles</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="recent-active dot-style d-flex">
                            @foreach ($recentArticles as $article)
                                <div class="single-recent mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('storage/' . $article->photo) }}" alt="" class="img-fluid"
                                        style="width: 300px; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="what-cap">
                                        <h4><a href="{{ url('/detail/' . $article->id) }}">{{ Str::limit($article->name, 40) }}</a></h4>
                                        <span class="color1">{{ $article->category->name }} - {{ $article->created_at->format('d M Y') }}</span>
                                        <h6>{{ Str::limit($article->content, 80) }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Articles End -->
@endsection
