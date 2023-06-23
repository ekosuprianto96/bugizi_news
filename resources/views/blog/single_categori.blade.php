@extends('blog.layouts.main')
@push('css-news')
<link rel="stylesheet" href="{{ asset('assets/blog/css/news.css') }}">
@endpush
@section('content-blog')
        <main class="main mt-md-2 p-md-3 m-sm-0" id="main">
            
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h1 class="font-bold text-center" style="font-size: 1.5em;">{{ $category->name }}</h1>
                    </div>
                </div>
            </div>

            <section class="container-fluid mt-2">
                <div class="row">
                    <div class="col-md-8">
                        <div class="content px-md-2">
                            <div class="row">
                                @foreach($posts->take(4) as $post)
                                    <div class="col-md-12 col-lg-6 mt-4 background-card mb-3">
                                        <section class="card-content shadow">
                                            <div class="img-card-content">
                                                <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="Image Content">
                                                <div class="kategori-card-content">
                                                    <a href="{{ route('category.single-category', $post->category->slug) }}" class="text-decoration-none"><span class="text-light" style="background-color: {{ $category->color }};border-radius:5px;"><strong>{{ $category->name }}</strong></span></a>
                                                </div>
                                            </div>
                                            <div class="text-card-content">
                                                <a href="{{ route('post.single-post', [$post->slug, $post->category->name]) }}" style="text-decoration: none;"><h3>{{ $post->title }}</h3></a>
                                                <div class="date">
                                                    <a href="single_categori.html" class="text-decoration-none"><span style="font-size: 0.9em;"><i class="bi bi-calendar-check-fill"></i> Posted on {{ $post->created_at->diffforHumans() }}</span></a>
                                                </div>
                                                <p>{{ $post->excerpt }}</p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span style="font-size: 0.8em;"><strong>Post By : {{ $post->post_by == null ? 'Admin' : $post->post_by }}</strong></span>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end align-items-center">
                                                        <span style="font-size: 0.8em;">{{ $post->views }} : <i class="bi bi-eye-fill"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
                            <hr style="background-color: rgb(59, 59, 59);height: 2px;width: 100%;">
                            <div class="row mt-3 mb-3">
                                <div class="col-12">
                                    <div class="row">
                                        @foreach($posts->skip(4)->take(4) as $post)
                                            <div class="col-12">
                                                <article class="content-kategori mt-3">
                                                    <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="" id="img-content-kategori">
                                                    <div class="text-content-kategori">
                                                        <a href="{{ route('post.single-post', [$post->slug, $post->category->name]) }}" style="text-decoration: none;"><h3>{{ $post->title }}</h3></a>
                                                        <a href="{{ route('category.single-category', $post->category->slug) }}" class="text-decoration-none"><span class="p-2 my-3 d-block text-light" style="background-color: {{ $post->category->color }};width:max-content;border-radius:5px;"><strong>{{ $post->category->name }}</strong></span></a>
                                                        <p>{{ $post->excerpt }}</p>
                                                        <a href="single_categori.html" class="text-decoration-none"><span style="font-size: 0.8em;"><i class="bi bi-calendar-check-fill"></i> Posted on {{ $post->created_at->diffforHumans() }}</span></a>
                                                        <div class="row my-3">
                                                            <div class="col-6">
                                                                <span style="font-size: 0.8em;white-space:nowrap;"><strong>Post By : {{ $post->post_by == null ? 'Admin' : $post->post_by }}</strong></span>
                                                            </div>
                                                            <div class="col-6 d-flex justify-content-end align-items-center">
                                                                <span style="font-size: 0.8em;">{{ $post->views }} : <i class="bi bi-eye-fill"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <aside class="col-md-4 px-md-2">
                        @if(isset($ads[0]) && $ads[0]->type === 'sidebar')
                            <div class="row mt-5">
                                <div class="col-12">
                                    <section class="iklan">
                                        <h5>{{ $ads[0]->title }}</h5>
                                        <a href="{{ $ads[0]->link }}">
                                            <img src="{{ asset('assets/blog/img/ads') }}/{{ $ads[0]->thumb }}" alt="" id="gambar-iklan" width="200px">
                                        </a>
                                    </section>
                                </div>
                            </div>
                        @endif
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="text-title-content">
                                    <h3>Latest Post</h3>
                                    <hr style="background-color: white;height: 2px;">
                                </div>
                                <div class="latest-post">
                                    @foreach($latest_post->take(5) as $post)
                                    <article class="content-latest-post mt-3">
                                        <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="" id="img-latest-post">
                                        <div class="text-latest-post">
                                            <a href="{{ route('post.single-post', [$post->slug, $post->category->name]) }}" style="text-decoration: none;"><h4>{{ $post->title }}</h4></a>
                                            <p>{{ $post->excerpt }}</p>
                                            <a href="" class="text-decoration-none" style="font-size: 0.8em;white-space: nowrap;"><span class="tanggal"><i class="bi bi-calendar-check-fill"></i> Posted on {{ $post->created_at->diffforHumans() }}</span></a>
                                            <div class="row mt-2">
                                                <div class="col-6 d-md-none d-lg-block">
                                                    <span style="font-size: 0.8em;white-space: nowrap;"><strong>Post By : {{ $post->post_by == null ? 'Admin' : $post->post_by }}</strong></span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end align-items-center d-md-none d-lg-flex">
                                                    <span style="font-size: 0.8em;">{{ $post->views }} : <i class="bi bi-eye-fill"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="text-title-content">
                                    <h3>Kategori</h3>
                                    <hr style="background-color: white;height: 2px;">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 kategori-sidebar">
                                        @foreach(App\Models\Category::all() as $category)
                                            <a href="{{ route('category.single-category', $category->slug) }}" style="text-decoration: none;"><h5>{{ $category->name }}</h5></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="icon-social-sidebar">
                                    @foreach(App\Models\SocialMedia::where('isSelected', 1)->get() as $social)
                                        <a href="{{ $social->url }}" style="text-decoration: none;"><i style="font-size: 2em;" class="mx-2 text-light {{ $social->icon }}"></i></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </section>
            
            <section>
                <div class="container-fluid mt-5">
                    <div class="row bg-dark shadow-sm p-3">
                        <div class="col-md-2">
                            <p class="text-slider-new">Berita Terbaru :</p>
                        </div>
                        <div class="col-md-6">
                            <div class="new-news-slider">
                                <div class="content-new-news-slider">
                                    @foreach(App\Models\Post::with('category')->where('is_slider', 1)->get() as $post)
                                    <a href="{{ route('post.single-post', [$post->slug, $post->category->name]) }}" style="text-decoration: none;"><span>{{ $post->title }}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-subscribe">
                                <form action="{{ route('subscribe.store') }}" method="post" class="form-subscribe">
                                    @csrf
                                    <input type="email" required placeholder="Enter your email..." name="email">
                                    <button type="submit" name="submite_subscribe">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
@endsection