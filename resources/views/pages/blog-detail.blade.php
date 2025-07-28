@extends('layouts.app')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $news->name }} | Galow Tunas Bangsa</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->content), 150) }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $news->name }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 150) }}" />
    <meta property="og:image" content="{{ url('uploads/' . $news->photo) }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="Galow Tunas Bangsa" />
    <meta property="article:published_time" content="{{ $news->created_at->toISOString() }}" />
    <meta property="article:author" content="{{ $news->author->name }}" />
    <meta property="article:section" content="{{ $news->category->name }}" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $news->name }}" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($news->content), 150) }}" />
    <meta name="twitter:image" content="{{ url('uploads/' . $news->photo) }}" />
    <meta name="twitter:site" content="@galowtunasbangsa" />

    <!-- Additional Meta Tags -->
    <meta name="author" content="{{ $news->author->name }}" />
    <meta name="keywords" content="{{ $news->category->name }}, Galow Tunas Bangsa, berita, {{ $news->name }}" />
@endsection

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
        }

        @media (max-width: 768px) {
            .about-img {
                height: 250px;
                /* Adjust height for mobile view */
                margin-bottom: -10px;
            }
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

        .related-posts {
            margin-top: 30px;
        }

        .related-posts h4 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .related-post-item {
            margin-bottom: 15px;
        }

        .related-post-item a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
        }

        .related-post-item a:hover {
            color: #e74c3c;
            /* Change to red on hover */
        }

        .share-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }

        .share-label {
            font-weight: bold;
            font-size: 1.3rem;
            letter-spacing: 1px;
            margin-bottom: 12px;
            text-align: center;
        }

        .share-buttons {
            display: flex;
            flex-direction: row;
            gap: 22px;
            justify-content: center;
            align-items: center;
        }

        .share-buttons .btn {
            width: 48px;
            height: 48px;
            min-width: 0;
            min-height: 0;
            max-width: 48px;
            max-height: 48px;
            border-radius: 50%;
            background: #fff;
            border: none;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: box-shadow 0.2s, background 0.2s;
            padding: 0;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .share-buttons .btn svg {
            width: 26px;
            height: 26px;
            display: block;
        }

        .share-buttons .btn.facebook {
            background: #1877F2;
        }

        .share-buttons .btn.facebook svg {
            color: #fff;
        }

        .share-buttons .btn.facebook:hover {
            box-shadow: 0 2px 8px #1877F2;
            background: #145dc2;
        }

        .share-buttons .btn.x {
            background: #111;
        }

        .share-buttons .btn.x svg {
            color: #fff;
        }

        .share-buttons .btn.x:hover {
            box-shadow: 0 2px 8px #111;
            background: #222;
        }

        .share-buttons .btn.whatsapp {
            background: #25D366;
        }

        .share-buttons .btn.whatsapp svg {
            color: #fff;
        }

        .share-buttons .btn.whatsapp:hover {
            box-shadow: 0 2px 8px #25D366;
            background: #1da851;
        }

        .views-badge {
            display: inline-flex;
            align-items: center;
            background: #f5f5f5;
            border-radius: 24px;
            padding: 5px 13px 5px 9px;
            font-size: 0.99rem;
            color: #444;
            font-weight: 500;
            margin-top: 8px;
            margin-bottom: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            gap: 6px;
        }

        .views-badge svg {
            width: 18px;
            height: 18px;
            color: #e74c3c;
            margin-right: 3px;
        }

        @media (max-width: 768px) {
            .share-buttons {
                gap: 14px;
            }

            .share-buttons .btn {
                width: 38px;
                height: 38px;
                max-width: 38px;
                max-height: 38px;
            }

            .share-buttons .btn svg {
                width: 18px;
                height: 18px;
            }

            .share-label {
                font-size: 1.05rem;
                margin-bottom: 8px;
            }
        }

        .section-tittle .meta-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 4px;
        }
    </style>
    <div class="about-area">
        <div class="container mt-20">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <div class="about-right mb-50">
                        <div class="about-img">
                            <img src="{{ asset('uploads/' . $news->photo) }}" alt="{{ $news->name }}">
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <span
                            style="color: #000; text-transform: uppercase; font-size: 11px; font-weight: 600; padding: 10px 15px; line-height: 1; margin-bottom: 15px; display: inline-block;"
                            class="color1">{{ $news->category->name }}</span>
                            <h4>{{ $news->name }}</h4>
                            <div style="display: flex; align-items: center; color: #555; font-size: 14px;">
                            {{-- Views --}}
                            <span style="display: inline-flex; align-items: center; gap: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 24 24">
                                    <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76
                                             0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3
                                             3 0 100 6 3 3 0 000-6z"/>
                                </svg>
                                {{ $news->views()->count() }} kali
                            </span>

                            {{-- Separator --}}
                            <span style="margin: 0 8px;">|</span>

                            {{-- Author --}}
                            <span>{{ $news->author->name }}</span>

                            {{-- Separator --}}
                            <span style="margin: 0 8px;">-</span>

                            {{-- Date --}}
                            <span>{{ $news->created_at->format('d M Y') }}</span>
                        </div>


                            {{-- Tampilkan Jumlah View --}}
                        </div>
                        <div class="about-prea">
                            <div class="about-pera1 mb-25">{!! Str::markdown($news->content) !!}</div>
                        </div>
                        <div class="share-section">
                            <div class="share-label">SHARE:</div>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank" class="btn facebook" title="Share to Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.794.715-1.794 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->name) }}"
                                    target="_blank" class="btn x" title="Share to X">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 1200 1227">
                                        <g>
                                            <path
                                                d="M1142 0h-222l-320 418L280 0H0l462 651L0 1227h222l320-418 320 418h280L738 576z" />
                                        </g>
                                    </svg>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($news->name . ' ' . request()->fullUrl()) }}"
                                    target="_blank" class="btn whatsapp" title="Share to WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.52 3.48A11.94 11.94 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.15 1.6 5.96L0 24l6.24-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.2-3.48-8.52zM12 22.05c-1.92 0-3.8-.5-5.45-1.45l-.39-.23-3.7.96.99-3.61-.25-.39A10.05 10.05 0 0 1 1.95 12c0-5.58 4.52-10.05 10.05-10.05 2.69 0 5.22 1.05 7.12 2.95a10.05 10.05 0 0 1 2.95 7.12c0 5.58-4.52 10.05-10.05 10.05zm5.8-7.88c-.32-.16-1.88-.93-2.17-1.04-.29-.1-.5-.16-.71.16-.2.32-.82 1.04-1.01 1.25-.18.2-.37.23-.69.08-.32-.16-1.35-.5-2.57-1.6-.95-.85-1.6-1.9-1.79-2.22-.18-.32-.02-.5.14-.66.14-.14.32-.37.48-.56.16-.18.2-.32.32-.53.1-.2.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.32-.26-.63-.52-.54-.71-.55h-.6c-.2 0-.53.08-.81.4-.28.32-1.06 1.04-1.06 2.54 0 1.5 1.09 2.96 1.24 3.17.16.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.72.23 1.37.2 1.88.12.57-.08 1.88-.77 2.15-1.5.27-.73.27-1.36.2-1.5-.08-.16-.29-.24-.6-.4z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="col-lg-4">
                    <div class="related-posts">
                        <h4 style="color: #e74c3c;">Related Posts</h4>

                        @if($relatedNews->isEmpty())
                            <div style="text-align:center; color:#888; margin-bottom:12px;">
                                Tidak ada berita yang terkait
                            </div>
                        @else
                            @foreach ($relatedNews as $related)
                                <div class="related-post-item d-flex mb-2">
                                    <div>
                                        <img src="{{ asset('uploads/' . $related->photo) }}"
                                             alt="{{ $related->name }}"
                                             style="width: 120px; height: 80px; object-fit: cover; margin-right: 20px;">
                                    </div>
                                    <div>
                                        <a href="{{ route('blog.detail', $related->slug) }}">
                                            {{-- Batasi judul maksimal 50 karakter --}}
                                            <strong>
                                                {{ \Illuminate\Support\Str::limit($related->name, 50, '...') }}
                                            </strong>
                                        </a>
                                        <p style="font-size: 0.9rem; color: #666;">
                                            {{ $related->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <hr style="margin: 10px 0; border-top: 1px solid #ddd;">

                        <div style="text-align:center; margin-top:24px; margin-bottom:24px">
                            <a href="https://galowtunasbangsa.com/halo.galow.pengaduan" target="_blank">
                                <img src="{{ asset('assets/img/logo/modal-pengaduan.jpg') }}"
                                     alt="Klik Gambar"
                                     style="max-width:100%; height:auto; box-shadow:0 2px 8px rgba(0,0,0,0.08); cursor:pointer;">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
