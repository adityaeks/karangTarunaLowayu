@extends('layouts.app')
@section('content')
    <style>
        .about-img {
            width: 100%;
            height: 500px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .about-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            /* padding: 20px; */
        }
        .section-tittle {
            margin-bottom: 30px;
        }
        .section-tittle h3 {
            font-size: 2rem;
            margin: 15px 0;
            line-height: 1.4;
        }
        .section-tittle span {
            color: #666;
            font-size: 0.9rem;
        }
        .about-prea {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
        }
        .about-pera1 {
            margin-bottom: 25px;
        }
    </style>
    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Trending Tittle -->
                    <div class="about-right mb-90">
                        <div class="about-img">
                            <img src="{{ asset('storage/' . $news->photo) }}" alt="{{ $news->name }}">
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <span
                                style="color: #000; text-transform: uppercase; font-size: 11px; font-weight: 600; padding: 10px 15px; line-height: 1; margin-bottom: 15px; display: inline-block;"
                                class="color1">{{ $news->category->name }}</span>
                            <h3>{{ $news->name }}</h3>
                            <span>{{ $news->author->name }} - {{ $news->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="about-prea">
                            <div class="about-pera1 mb-25">{!! Str::markdown($news->content) !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
