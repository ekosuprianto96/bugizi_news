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
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-backspace-fill"></i> Back</a>
        </div>
    </div>
    <form action="{{ route('admin.post-create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row my-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="input-excerpt mb-3">
                            <label for="excerpt" class="form-label"><strong>Excerpt</strong></label>
                            <textarea style="resize: none;" class="form-control  @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt" style="max-height: 200px;" required></textarea>
                            <p></p>
                            @error('excerpt')
                                <div class="invalid-feedback">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <label for="body" class="form-label"><strong>Body</strong></label>
                        <textarea name="body" id="summernote"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Title Post</strong></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title post..." required>
                            @error('title')
                                <div class="invalid-feedback">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-title mb-3">
                            <label for="slug" class="form-label"><strong>Slug Post</strong></label>
                            <input type="text" name="slug" id="slug" readonly class="form-control @error('slug') is-invalid @enderror" placeholder="Slug post..." required>
                            @error('slug')
                                <div class="invalid-feedback">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-title mb-3">
                            <label for="title" class="form-label"><strong>Category Post</strong></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                <option value="" selected>Select category...</option>
                                @foreach($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <label for="title" class="form-label"><strong>Thumbnail Post</strong></label>
                        <div class="thumb-post mb-3">
                            <input type="file" name="thumb_post" id="thumb_post">
                            <i class="bi bi-image"></i>
                            <span><strong>Thumbnail Post</strong></span>
                            <img src="" alt="" id="image-prev">
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
    const excerpt = document.querySelector('#excerpt');
    const textP = document.querySelector('.input-excerpt p');
    let lengthExcerpt = 250;
    textP.textContent = `Max : ${lengthExcerpt}`;
    excerpt.addEventListener('keyup', (e) => {
        const inputExcerpt = document.querySelector('.input-excerpt');
        textP.textContent = `Length : ${e.target.value.length}`;
        if(e.target.value.length > 250) {
            textP.textContent = `Karakter excerpt tidak boleh lebih dari ${lengthExcerpt}!`;
            textP.setAttribute('class', 'text-danger');
            excerpt.classList.add('is-invalid');
            excerpt.setAttribute('onkeypress', 'return false')
        }else {
            excerpt.classList.remove('is-invalid');
            textP.classList.remove('text-danger');
            excerpt.removeAttribute('onkeypress')
        }
    });
    excerpt.addEventListener('blur', (e) => {
        textP.textContent = `Max : ${lengthExcerpt}`;
    })
</script>
@endsection