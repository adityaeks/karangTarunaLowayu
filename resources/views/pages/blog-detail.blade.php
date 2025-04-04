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

        .share-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .share-buttons .btn {
            flex: 1 1 calc(33.33% - 10px);
            /* Default: 3 items per row */
            text-align: center;
        }

        @media (max-width: 768px) {
            .share-buttons .btn {
                flex: 1 1 100%;
                /* Mobile: 1 item per row */
            }
        }
    </style>
    <div class="about-area">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <div class="about-right mb-50">
                        <div class="about-img">
                            <img src="{{ asset('storage/' . $news->photo) }}" alt="{{ $news->name }}">
                        </div>
                        <div class="section-tittle mb-30 pt-30">
                            <span
                                style="color: #000; text-transform: uppercase; font-size: 11px; font-weight: 600; padding: 10px 15px; line-height: 1; margin-bottom: 15px; display: inline-block;"
                                class="color1">{{ $news->category->name }}</span>
                            <h3>{{ $news->name }}</h3>
                            <span>
                                {{ $news->author->name }} - {{ $news->created_at->format('d M Y') }}

                            </span>
                        </div>
                        <div class="about-prea">
                            <div class="about-pera1 mb-25">{!! Str::markdown($news->content) !!}</div>
                        </div>
                        <p>Share this post:</p>
                        <div class="share-buttons mt-30">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn facebook"
                                style="color: #fff; background-color: #1877F2; padding: 10px; border-radius: 5px; display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 5px;">
                                    <path
                                        d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.794.715-1.794 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z" />
                                </svg>
                                Facebook
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($news->name . ' ' . request()->fullUrl()) }}"
                                target="_blank" class="btn whatsapp"
                                style="color: #fff; background-color: #25D366; padding: 10px; border-radius: 5px; display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 5px;">
                                    <path
                                        d="M20.52 3.48A11.94 11.94 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.15 1.6 5.96L0 24l6.24-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.2-3.48-8.52zM12 22.05c-1.92 0-3.8-.5-5.45-1.45l-.39-.23-3.7.96.99-3.61-.25-.39A10.05 10.05 0 0 1 1.95 12c0-5.58 4.52-10.05 10.05-10.05 2.69 0 5.22 1.05 7.12 2.95a10.05 10.05 0 0 1 2.95 7.12c0 5.58-4.52 10.05-10.05 10.05zm5.8-7.88c-.32-.16-1.88-.93-2.17-1.04-.29-.1-.5-.16-.71.16-.2.32-.82 1.04-1.01 1.25-.18.2-.37.23-.69.08-.32-.16-1.35-.5-2.57-1.6-.95-.85-1.6-1.9-1.79-2.22-.18-.32-.02-.5.14-.66.14-.14.32-.37.48-.56.16-.18.2-.32.32-.53.1-.2.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.32-.26-.63-.52-.54-.71-.55h-.6c-.2 0-.53.08-.81.4-.28.32-1.06 1.04-1.06 2.54 0 1.5 1.09 2.96 1.24 3.17.16.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.72.23 1.37.2 1.88.12.57-.08 1.88-.77 2.15-1.5.27-.73.27-1.36.2-1.5-.08-.16-.29-.24-.6-.4z" />
                                </svg>
                                WhatsApp
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" class="btn instagram"
                                style="color: #fff; background-color: #E4405F; padding: 10px; border-radius: 5px; display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 5px;">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.246 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.246-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.246-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.246 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163C8.756 0 8.332.013 7.052.072 5.772.131 4.548.39 3.5 1.438 2.452 2.486 2.193 3.71 2.134 4.99.013 8.332 0 8.756 0 12c0 3.244.013 3.668.072 4.948.059 1.28.318 2.504 1.366 3.552 1.048 1.048 2.272 1.307 3.552 1.366 1.28.059 1.704.072 4.948.072s3.668-.013 4.948-.072c1.28-.059 2.504-.318 3.552-1.366 1.048-1.048 1.307-2.272 1.366-3.552.059-1.28.072-1.704.072-4.948s-.013-3.668-.072-4.948c-.059-1.28-.318-2.504-1.366-3.552-1.048-1.048-2.272-1.307-3.552-1.366C15.668.013 15.244 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 0 0-2.88 1.44 1.44 0 0 0 0 2.88z" />
                                </svg>
                                Instagram
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="col-lg-4">
                    <div class="related-posts">
                        <h4 style="color: #e74c3c;">Related Posts</h4>
                        @foreach ($relatedNews as $related)
                            <div class="related-post-item d-flex mb-2">
                                <div>
                                    <img src="{{ asset('storage/' . $related->photo) }}" alt="{{ $related->name }}"
                                        style="width: 120px; height: 80px; object-fit: cover; margin-right: 20px;">
                                </div>
                                <div>
                                    <a href="{{ route('blog.detail', $related->slug) }}">
                                        <strong>{{ $related->name }}</strong>
                                    </a>
                                    <p style="font-size: 0.9rem; color: #666;">{{ $related->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <hr style="margin: 10px 0; border-top: 1px solid #ddd;">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
