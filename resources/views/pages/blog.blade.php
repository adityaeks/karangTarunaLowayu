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
            border-radius: 2px;
            overflow: hidden;
        }
        .blog_item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        .blog_details h2 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            line-height: 1.4;
            height: 2.4em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
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
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .category-list li {
            margin-bottom: 10px;
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
                                        <input type="text" class="form-control" name="query" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Berita'">
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget" style="padding-top: 20px;">
                            <h4 class="widget_title">Kategori</h4>
                            <ul class="category-list">
                                <li>
                                    <a href="{{ url('/blog') }}" class="{{ !request('category') ? 'active' : '' }}">
                                        Semua Kategori
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ url('/blog?category=' . $category->id) }}"
                                           class="{{ request('category') == $category->id ? 'active' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>

                <div class="col-lg-9">
                    @if(isset($news) && $news->count() > 0)
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
                                                    <li><i class="fa fa-calendar"></i>{{ $item->created_at->format('d/m/Y') }} </li>
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
                        <p>No news found for your search query.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
