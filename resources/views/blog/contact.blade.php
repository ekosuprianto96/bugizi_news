@extends('blog.layouts.main')

@section('content-blog')
        <main class="main mt-md-2 p-md-3 m-sm-0" id="main">
            
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="font-bold text-center">Contact</h1>
                    </div>
                </div>
            </div>

            <section class="contact mt-4">
                <section class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12 p-0">
                                        <form action="{{ route('contact.send') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input id="name" name="name" type="text" class="form-control mb-3">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input id="phone" name="phone" type="text" class="form-control mb-3">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input id="email" name="email" type="email" class="form-control mb-3">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input id="address" name="address" type="text" class="form-control mb-3">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <input id="subject" name="subject" type="text" class="form-control mb-3">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <button type="submit" id="submit" style="background-color: #FF6363;" class="btn w-100 text-light">Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($posts->take(7) as $post)
                                        <div class="col-12">
                                            <article class="content-kategori mt-3 p-3">
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
                        <aside class="col-md-4 px-md-2">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="text-title-content">
                                        <h3>Latest Post</h3>
                                        <hr style="background-color: white;height: 2px;">
                                    </div>
                                    <div class="latest-post">
                                        @foreach($posts->take(5) as $post)
                                        <article class="content-latest-post mt-3">
                                            <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="" id="img-latest-post">
                                            <div class="text-latest-post">
                                                <a href="{{ route('post.single-post', [$post->slug, $post->category->name]) }}" style="text-decoration: none;"><h4>{{ $post->title }}</h4></a>
                                                <p>{{ $post->excerpt }}</p>
                                                <a href="" class="text-decoration-none"><span class="tanggal"><i class="bi bi-calendar-check-fill"></i> Posted on {{ $post->created_at->diffforHumans() }}</span></a>
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <span style="font-size: 0.8em;"><strong>Post By : {{ $post->post_by == null ? 'Admin' : $post->post_by }}</strong></span>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end align-items-center">
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