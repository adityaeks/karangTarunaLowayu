@extends('layouts.app')
@section('content')
    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Trending Tittle -->
                    <div class="about-right mb-90">
                        <div class="about-img">
                            <img src="{{ asset('storage/' . $news->photo) }}" alt="">
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <span
                                style="color: #000; text-transform: uppercase; font-size: 11px; font-weight: 600; padding: 10px 15px; line-height: 1; margin-bottom: 15px; display: inline-block;"
                                class="color1">{{ $news->category->name }}</span>
                            <h3>{{ $news->name }}</h3>
                            <span>{{ $news->author->name }} - {{ $news->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="about-prea">
                            <p class="about-pera1 mb-25">{{ $news->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
