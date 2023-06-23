@extends('blog.layouts.main')
@push('css-single-post')
<link rel="stylesheet" href="{{ asset('assets/blog/css/single_post.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
@endpush
<style>
    div#social-links {
        max-width: 100%;
        height: auto;
        position: relative;
        padding: 10px;
        padding-left: 0;
    }
    div#social-links ul {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        position: relative;
    }
    div#social-links ul li {
        list-style: none;
    }          
    div#social-links ul li a {
        padding: 10px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #ccc;
    }
</style>
@section('content-blog')
        <main class="main p-md-3" id="main">
            <section class="container-fluid">
                <div class="row mt-3">
                    <div class="col-md-8">
                        <div class="content px-md-2">
                            <article id="article">
                                <div class="image-content">
                                    <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="Image Post" width="100%">
                                </div>
                                <div class="kategori-article">
                                    <span style="background-color: {{ $post->category->color }}">{{ $post->category->name }}</span>
                                </div>
                                <div class="text-article-content my-3">
                                    <h2>{{ $post->title }}</h2>
                                    <div class="info-article">
                                        <span class="date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                          </svg> {{ $post->created_at->format('d M Y') }}
                                        </span>
                                        <span class="author">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg> {{ $post->post_by == null ? 'Admin' : $post->post_by }}
                                        </span>
                                    </div>
                                    <hr>
                                    <div class="body-article">
                                        {!! nl2br($post->body) !!}
                                    </div>
                                </div>
                                <div class="info-view-article my-5">
                                    <div class="row w-100">
                                        <div class="col-6">
                                            <div class="comment">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                                </svg>
                                                <span>Comment : {{ $post->comments->count() }}</span>
                                            </div>
                                        </div>
                                    <!-- <div class="button-comment">
                                        <button class="btn btn-danger" id="add-comment">Tambahkan Komentar</button>
                                    </div> -->
                                        <div class="col-6 d-flex justify-content-end align-items-center">
                                            <div class="view">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
                                                <span>View : {{ $post->views }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        {!! $shareSocial !!}
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-lg-12">
                                        <h3>Komentar</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" id="section-comment">
                                    @foreach($post->comments as $comment)
                                    <div class="col-lg-12 mb-3 col-sm-12 p-lg-4">
                                        <div class="comment-user">
                                            <div class="avatar-image">
                                                <img src="{{ asset('assets/blog/img/avatar/') }}/{{ $comment->image }}" alt="Avatar">
                                            </div>
                                            <div class="content-comment">
                                                <h6 class="mb-3"><strong>{{ $comment->username }}</strong></h6>
                                                <p>{{ $comment->content }}</p>
                                                <span style="font-size: 0.8em;"><strong>{{ $comment->created_at->diffforHumans() }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('post.comment') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="slug_post" value="{{ $post->slug }}">
                                                <div class="col-6 mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="gendre" class="form-label">Gendre</label>
                                                    <select name="gendre" id="gendre" class="form-control">
                                                        <option selected>Select Gendre</option>
                                                        <option value="male">Male</option>
                                                        <option value="famale">Famale</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <label for="floatingTextarea2">Comments</label>
                                                            <textarea name="content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Send Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="profile-author">
                                    <img src="assets/img/profile.jpg" alt="Profile Author">
                                    <div class="text-profile-author">
                                        <h4>Eko Suprianto</h4>
                                        <p>Hallo saya adalah seorang Front End developer yang sedang aktif bekerja</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <aside class="col-md-4 px-md-3">
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
                                    @foreach($posts->take(5) as $post)
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
                                    <h3>Tag</h3>
                                    <hr style="background-color: white;height: 2px;">
                                </div>
                                <div class="tag-article mt-3">
                                    @foreach($post->tags as $tag)
                                    <a href="" class="text-decoration-none"><span>{{ $tag->name }}</span></a>
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
@push('share')
<script src="{{ asset('js/share.js') }}"></script>
@endpush
@endsection