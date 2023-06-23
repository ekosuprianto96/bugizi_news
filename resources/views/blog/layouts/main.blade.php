<!doctype html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/blog/bootstrap/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/blog/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/blog/css/hero-images.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/blog/css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/blog/css/card-full-image.css') }}">
    @stack('css-single-post')
    @stack('css-news')

    <title>{{ App\Models\DetailWebsite::find(1)->app_name }} - {{ $title }}</title>
  </head>
  <body>
        <!-- PRELOADER -->
        <div class="preeloader" id="loader">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <!-- HEADER -->
        <header class="header" id="header-menu"> 
            <div class="container">
                <nav class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="logo">
                            @if( App\Models\DetailWebsite::first()->logo_web !== null )
                                <img src="{{ asset('assets/admin/img/logo_img/') }}/{{ App\Models\DetailWebsite::first()->logo_web }}" alt="" id="logo_img">
                            @endif
                            <a href="/" style="text-decoration: none;" class="my-0"><h1><b>{{ App\Models\DetailWebsite::first()->app_name }}</b></h1></a>
                            <div class="menu-humb" id="menu-humb">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-0">
                        <div class="menu d-flex justify-content-end align-items-center">
                            <ul class="menu-list">
                                <li><a href="/">Home</a></li>
                                <li class="menu-dropdown"><a href="#">News</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FAF5E4" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <ul class="content-dropdown">
                                        <li><a href="{{ route('post.all-posts') }}">All Posts</a></li>
                                        @foreach(App\Models\Category::all() as $category)
                                        <li><a href="{{ route('category.single-category', $category->slug) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="single_categori.html">Travel</a></li>
                                <li><a href="single_categori.html">Tips & Trick</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="menu-mobile">
                <ul class="menu-list-mobile">
                    <li><a href="/">Home</a></li>
                    <li class="menu-dropdown"><a href="#">News</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FAF5E4" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                          </svg>
                        <ul class="content-dropdown">
                            <li><a href="{{ route('post.all-posts') }}">All Posts</a></li>
                            @foreach(App\Models\Category::all() as $category)
                                <li><a href="{{ route('category.single-category', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="single_categori.html">Travel</a></li>
                    <li><a href="single_categori.html">Tips & Trick</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </header>

        @yield('content-blog')

        
        <footer id="footer" class="mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="logo-footer">
                            <h3>{{ App\Models\DetailWebsite::first()->app_name }}</h3>
                            <p>&copy;Copy right {{ App\Models\DetailWebsite::first()->app_name }} {{ \Carbon\carbon::now()->format('Y') }}</p>
                            <p>Design By <a href="ekhosaputra23@gmail.com" style="text-decoration: none;">Eko Suprianto</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav class="navigation-footer">
                            <ul class="menu-footer">
                                @foreach(App\Models\SocialMedia::where('isSelected', 1)->get() as $social)
                                    <li><a href="{{ $social->url }}" style="text-decoration: none;"><i style="font-size: 2em;" class="mx-2 text-light {{ $social->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('assets/blog/js/menu.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    @stack('share')
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>