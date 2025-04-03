@extends('layouts.app')
@section('content')
    @php
        use League\CommonMark\CommonMarkConverter;
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    @endphp
    <style>
        .blog_item {
            height: 90%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #eee;
            border-bottom: 4px solid #e74c3c;
            border-radius: 2px;
            overflow: hidden;
        }

        .blog_item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .blog_item_img {
            position: relative;
            height: 180px;
            overflow: hidden;
            width: 100%;
        }

        .blog_item_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .blog_details {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 15px;
            min-height: 200px;
        }

        /* Tetapkan warna default untuk judul */
        .blog_details h2 {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 8px;
            line-height: 1.4;
            height: 2.4em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            transition: color 0.3s ease;
        }

        /* Warna default untuk paragraf */
        .blog_details p {
            color: #555;
        }

        /* Aturan untuk link di dalam blog item */
        .blog-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .blog-link:hover {
            text-decoration: none;
            color: inherit;
        }

        /* Aturan untuk info link di bagian bawah blog item */
        .blog-info-link {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-top: auto;
        }

        .blog-info-link li {
            display: inline-block;
            margin-right: 15px;
            font-size: 0.85rem;
            color: #666;
        }

        .blog-info-link li i {
            margin-right: 5px;
        }

        /* Aturan untuk daftar kategori */
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
            /* border: 1px solid #ddd; */ /* Remove border from the category list */
            border-radius: 4px; /* Optional: rounded corners */
        }

        .category-list li {
            margin-bottom: 10px;
            /* border-bottom: 1px solid #ddd; */ /* Remove border between items */
        }

        .category-list li:last-child {
            /* border-bottom: none; */ /* Remove border for the last item */
        }

        .category-list a {
            color: #666;
            text-decoration: none;
            display: block;
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .category-list a:hover,
        .category-list a.active {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            /* border: 1px solid #e74c3c; */ /* Remove border from active/hovered items */
        }

        /* Hanya mengubah warna judul (h2) saat hover pada blog_item */
        .blog_item:hover h2 {
            color: #e74c3c !important;
        }
    </style>
    <section class="blog_area mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="blog_left_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="{{ url('/search') }}" method="GET">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="query"
                                            placeholder='Search Keyword' onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Cari Berita'">
                                        {{-- Include the selected category in the search query --}}
                                        @if(request('category'))
                                            <input type="hidden" name="category" value="{{ request('category') }}">
                                        @endif
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget mb-4" style="padding-top: 20px;">
                            <h4 class="widget_title">Kategori</h4>
                            <ul class="category-list">
                                <li>
                                    <a href="{{ url('/blog') }}" class="{{ !request('category') ? 'active' : '' }}">
                                        Semua Kategori
                                        <span style="float: right;">({{ $totalNewsCount }})</span>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ url('/blog?category=' . $category->id) }}"
                                            class="{{ request('category') == $category->id ? 'active' : '' }}">
                                            {{ $category->name }}
                                            <span style="float: right;">({{ $category->beritas->count() }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>

                <div class="col-lg-9 mt-4">
                    @if (isset($news) && $news->count() > 0)
                        <div class="row">
                            @foreach ($news as $item)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ url('/detail/' . $item->slug) }}" class="blog-link">
                                        <article class="blog_item">
                                            <div class="blog_item_img">
                                                <img class="card-img rounded-0" src="{{ asset('storage/' . $item->photo) }}"
                                                    alt="{{ $item->name }}">
                                            </div>

                                            <div class="blog_details">
                                                <h2>{{ Str::limit($item->name, 50) }}</h2>
                                                <p>{{ Str::limit($item->content, 120) }}</p>
                                                {{-- <div class="markdown-content">
                                                    {!! Str::limit($converter->convert($item->content)->getContent(), 150) !!}
                                                </div> --}}
                                                <ul class="blog-info-link">
                                                    <li><i class="fa fa-folder"></i> {{ $item->category->name }}</li>
                                                    <li><i
                                                            class="fa fa-calendar"></i>{{ $item->created_at->format('d/m/Y') }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </article>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <nav class="blog-pagination justify-content-center d-flex">
                            {{ $news->links() }}
                        </nav>
                    @else
                        <div class="no-results text-center mt-5 mb-5">
                            <i class="fa fa-search fa-3x text-muted mb-3"></i>
                            <h3 class="text-muted">Oops! Tidak ada hasil ditemukan.</h3>
                            <p class="text-muted">Kami tidak dapat menemukan berita yang sesuai dengan pencarian Anda. Cobalah kata kunci lain atau periksa kategori yang Anda pilih.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
