@extends('admin.layouts.main')

@push('css-data-table')
<link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endpush
<style>
    .select-post {
        border: 1px solid;
        padding: 7px;
        position: relative;
        border-radius: 5px;
        background-color: rgb(230, 230, 230);
    }
    .select-post-rekomen {
        border: 1px solid;
        padding: 7px;
        position: relative;
        border-radius: 5px;
        background-color: rgb(230, 230, 230);
    }
    #icon-select {
        position: absolute;
        right: 5px;
        top: 10px;
        transition: 0.3s;
    }
    #icon-select-rekomen {
        position: absolute;
        right: 5px;
        top: 10px;
        transition: 0.3s;
    }
    .list-post {
        position: absolute;
        top: 105%;
        border: 1px solid;
        width: 100%;
        left: 0;
        z-index: 99999;
        background-color: white;
        box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.219);
        transition: 0.3s;
    }
    .list-post-rekomen {
        position: absolute;
        top: 105%;
        border: 1px solid;
        width: 100%;
        left: 0;
        z-index: 99999;
        background-color: white;
        box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.219);
        transition: 0.3s;
    }
    .content-post {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 7px;
    }
    .content-post span {
        max-width: 90%;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
@section('content-admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h1 class="h3 m-0">List Of Post</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-backspace-fill"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 my-3">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               Total Views</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $views }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-eye-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 my-3">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Comments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Comment::all()->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chat-dots-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 my-3">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Visitors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">30</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 my-3">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $post_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12">
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <style>
                        #dataTable_filter {
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }
                        #dataTable_paginate {
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }
                    </style>
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap;" class="text-center">No</th>
                                    <th style="white-space: nowrap;" class="text-center">ThumbNail</th>
                                    <th style="white-space: nowrap;" class="text-center">Title</th>
                                    <th style="white-space: nowrap;" class="text-center">Excerpt</th>
                                    <th style="white-space: nowrap;" class="text-center">Category</th>
                                    <th style="white-space: nowrap;" class="text-center">View</th>
                                    <th style="white-space: nowrap;" class="text-center">Comment</th>
                                    <th style="white-space: nowrap;" class="text-center">Created At</th>
                                    <th style="white-space: nowrap;" class="text-center">Updated At</th>
                                    <th style="white-space: nowrap;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                   $i = 1; 
                                @endphp
                                @foreach($posts as $index => $post)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="Thumbnail Post" width="80">
                                    </td>
                                    <td style="white-space: nowrap;max-width: 200px;overflow:hidden;text-overflow:ellipsis;">{{ $post->title }}</td>
                                    <td style="white-space: nowrap;max-width: 200px;overflow:hidden;text-overflow:ellipsis;">{{ $post->excerpt }}</td>
                                    <td style="white-space: nowrap;">{{ $post->category->name }}</td>
                                    <td style="white-space: nowrap;">{{ $post->views }}</td>
                                    <td style="white-space: nowrap;">{{ $post->comments->count() }}</td>
                                    <td style="white-space: nowrap;">{{ $post->created_at->format('d M Y') }}</td>
                                    <td style="white-space: nowrap;">{{ $post->updated_at->format('d M Y') }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('admin.post-edit', $post->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('admin.post-delete', $post->slug) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="h4 m-0">Add Post Slider</h1>
                </div>
                <div class="card-body">
                    <strong>Tambahkan slider animation postingan di atas footer maksimal 10 postingan!</strong>
                    <div class="select-post mt-3">
                        <i class="bi bi-caret-left-fill" id="icon-select"></i>
                        <span>Select Post</span>
                        <div class="list-post d-none">
                            @foreach($posts_pagin as $post)
                            <div class="content-post">
                                <span>{{ $post->title }}</span>
                                <input data-slug-post="{{ $post->slug }}" value="{{ $post->is_slider }}" class="input-range" type="range" style="width:30px;" max="1">
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    {{ $posts_pagin->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="list-post-slider">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="h4 m-0">Add Post Rekomendasi</h1>
                </div>
                <div class="card-body">
                    <strong>Tambahkan Rekomendasi Postingan di Side Bar maksimal 7 postingan!</strong>
                    <div class="select-post-rekomen mt-3">
                        <i class="bi bi-caret-left-fill" id="icon-select-rekomen"></i>
                        <span>Select Post</span>
                        <div class="list-post-rekomen d-none">
                            @foreach($posts_pagin as $post)
                            <div class="content-post">
                                <span>{{ $post->title }}</span>
                                <input data-slug-post="{{ $post->slug }}" value="{{ $post->is_recomendation }}" class="input-range-rekomen" type="range" style="width:30px;" max="1">
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    {{ $posts_pagin->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="list-post-rekomen">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('contoh')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
</script>
@endpush
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const parent = document.querySelector('#list-post-slider');
        const parent2 = document.querySelector('#list-post-rekomen');
        const route1 = '{{ route("admin.api-all-post") }}';
        const route2 = '{{ route("admin.api-all-post-rekomen") }}';
        render(parent, route1);
        render(parent2, route2);
    })
    const sliderPost = document.querySelector('.select-post');
    const sliderPostRekomen = document.querySelector('.select-post-rekomen');
    const inputRange = document.querySelectorAll('.input-range');
    const inputRangeRekomen = document.querySelectorAll('.input-range-rekomen');
    sliderPost.addEventListener('click', (e) => {
        const list = document.querySelector('.list-post');
        if(list.classList.contains('d-none') !== false) {
            document.querySelector('#icon-select').style.transform = 'rotate(-90deg)';
        }else {
            document.querySelector('#icon-select').style.transform = 'rotate(0deg)';
        }
        if(e.target.className !== 'input-range') {
            list.classList.toggle('d-none');
        }
    })
    sliderPostRekomen.addEventListener('click', (e) => {
        const listRekomen = document.querySelector('.list-post-rekomen');
        if(listRekomen.classList.contains('d-none') !== false) {
            document.querySelector('#icon-select-rekomen').style.transform = 'rotate(-90deg)';
        }else {
            document.querySelector('#icon-select-rekomen').style.transform = 'rotate(0deg)';
        }
        if(e.target.className !== 'input-range-rekomen') {
            listRekomen.classList.toggle('d-none');
        }
    })
    inputRange.forEach(element => {
        element.addEventListener('change', (e) => {
            console.log(e.target.value)
            const slug = e.target.getAttribute('data-slug-post');
            const slidValue = e.target.value;
            const formData = new FormData();
            const __token = `{{ csrf_token() }}`;
            const route = '{{ route("admin.api-all-post") }}';
            formData.append('value', slidValue);
            formData.append('slug', slug);
            fetch(`{{ route('admin.api-slider-post') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': __token,
                },
                credentials: 'same-origin',
                body: formData
            }).then(response => response.json())
            .then(data => {
                if(data.message === 'success') {
                    e.target.value = data.result;
                    const parent = document.querySelector('#list-post-slider');
                    render(parent, route)
                }else {
                    alert('Slider Maksimal 10 Postingan');
                    e.target.value = 0;
                    render(parent, route)
                }
            })
            .catch(error => console.log(error))
        })
    });
    inputRangeRekomen.forEach(element => {
        element.addEventListener('change', (e) => {
            console.log(e.target.value)
            const slug = e.target.getAttribute('data-slug-post');
            const slidValue = e.target.value;
            const formData = new FormData();
            const __token = `{{ csrf_token() }}`;
            const routeRekomen = '{{ route("admin.api-all-post-rekomen") }}';
            formData.append('value', slidValue);
            formData.append('slug', slug);
            fetch(`{{ route('admin.api-rekomen-post') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': __token,
                },
                credentials: 'same-origin',
                body: formData
            }).then(response => response.json())
            .then(data => {
                console.log(data)
                if(data.message === 'success') {
                    e.target.value = data.result;
                    const parent = document.querySelector('#list-post-rekomen');
                    render(parent, routeRekomen)
                }else {
                    alert('Slider Maksimal 7 Postingan');
                    e.target.value = 0;
                    render(parent, routeRekomen)
                }
            })
            .catch(error => console.log(error))
        })
    });
    function render(parent, route) {
        let no = 1;
        parent.innerHTML = '';
        fetch(route, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            const result = data.data;
            if(result.length <= 0) {
                const textStr = document.createElement('strong');
                textStr.textContent = 'Tidak Ada Post!';
                textStr.setAttribute('class', 'text-center w-100')
                parent.append(textStr);
            }
            result.forEach(element => {
                const divcol12 = document.createElement('div');
                divcol12.setAttribute('class', 'col-12 mb-3');
                divcol12.innerHTML = `<div class="row">
                                        <div class="col-2">
                                            ${no++}
                                        </div>
                                        <div class="col-10"><span>${element.title}</span></div>
                                    </div>`
                parent.append(divcol12);
            })
        })
        
    }
</script>
@endsection