@extends('admin.layouts.main')
@push('new-post')
    <link href="{{ asset('assets/admin/css/new-post.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('summernote')
<!-- include libraries(jQuery, bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@section('content-admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h1 class="h3 m-0">Create New Post</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.post-update') }}"><i class="bi bi-backspace-fill"></i> Back</a>
        </div>
    </div>
    <form action="{{ route('admin.post-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row my-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" value="{{ $post->slug }}" name="slug_post">
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Excerpt</strong></label>
                            <textarea style="resize: none;" class="form-control" name="excerpt" id="excerpt" style="max-height: 200px;">{{ $post->excerpt }}</textarea>
                        </div>
                        <label for="title" class="form-label"><strong>Body</strong></label>
                        <textarea name="body" id="summernote">{{ $post->body }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Title Post</strong></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title post..." value="{{ $post->title }}">
                        </div>
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Slug Post</strong></label>
                            <input type="text" name="slug" id="slug" readonly class="form-control" placeholder="Slug post..." value="{{ $post->slug }}">
                        </div>
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Category Post</strong></label>
                            <select class="form-control" name="category_id" id="category">
                                <option value="" selected>Select category...</option>
                                @foreach($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="title" class="form-label"><strong>Thumbnail Post</strong></label>
                        <div class="thumb-post mb-3">
                            <input type="file" name="thumb_post" id="thumb_post">
                            <i class="bi bi-image"></i>
                            <span><strong>Thumbnail Post</strong></span>
                            <img src="{{ asset('assets/admin/img/thumb_post/') }}/{{ $post->thumbnail_post }}" alt="" id="image-prev">
                        </div>
                        <div class="tags">
                            <label for="multi-value-select">Tags</label>
                            <select name="tags[]" id="multi-value-select" class="form-control" multiple="multiple">
                            </select>
                        </div>
                        <div class="col-12 my-3 px-0">
                            <button type="submit" class="btn btn-primary w-100">Send Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            // height: 400,
            minHeight: 600,
            maxHeight: 600
        });
    });
    $("#multi-value-select").select2({
        tags: true
    });
</script>
<script>
    const title = document.querySelector('#title');
    title.addEventListener('blur', (e) => {
        const slug = document.querySelector('#slug');
         let valueTitle = e.target.value.toString().toLowerCase()
                                                    .replace(/^-+/, '')
                                                    .replace(/-+$/, '')
                                                    .replace(/\s+/g, '-')
                                                    .replace(/\-\-+/g, '-')
                                                    .replace(/[^\w\-]+/g, '');
        slug.value = valueTitle;
    });
    const thumbPost = document.querySelector('#thumb_post');
    thumbPost.addEventListener('change', (e) => {
        const imagePrev = document.querySelector('#image-prev');
        const src = URL.createObjectURL(e.target.files[0]);
        imagePrev.src = src;
    })
</script>
@endsection