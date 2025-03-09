@extends('layouts.app')
@section('content')
    <section class="blog_area mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
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
                        <br>
                        @if(isset($news) && $news->count() > 0)
                            @foreach ($news as $item)
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{ asset('storage/' . $item->photo) }}"
                                            alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3>{{ $item->created_at->format('d') }}</h3>
                                            <p>{{ $item->created_at->format('M') }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ url('/detail/' . $item->id) }}">
                                            <h2>{{ $item->name }}</h2>
                                        </a>
                                        <p>{{ Str::limit($item->content, 150) }}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="#"><i class="fa fa-user"></i> {{ $item->category->name }}</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach
                            <nav class="blog-pagination justify-content-center d-flex">
                                {{ $news->links() }}
                            </nav>
                        @else
                            <p>No news found for your search query.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
