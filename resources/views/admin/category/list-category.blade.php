@extends('admin.layouts.main')
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
@endpush
@section('content-admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h1 class="h3 m-0">List Of Category</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-backspace-fill"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-3 p-3">
                <div class="row p-3">
                    <div class="col-6">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#form_new_category">New Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Name</td>
                                    <td>Slug</td>
                                    <td>Color</td>
                                    <td>Created At</td>
                                    <td>Updated At</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorys as $category)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <div class="card" style="background-color: {{ $category->color }};">
                                            <div class="card-body text-dark">
                                                {{ $category->color }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $category->created_at->format('d M Y') }}</td>
                                    <td>{{ $category->updated_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="" id="{{ $category->slug }}" data-toggle="modal" data-target="#form_edit_category" class="btn btn-sm btn-success button-edit">Edit</a>
                                        <a href="{{ route('admin.category-delete', $category->slug) }}" class="btn btn-sm btn-danger">Delete</a>
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
</div>

<!-- Modal -->
<div class="modal fade" id="form_new_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.category-create') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Category name..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Slug</label>
                    <input type="text" readonly class="form-control" name="slug" id="slug" placeholder="Slug..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Color</label>
                    <input class="form-control" type="color" name="color" id="color" placeholder="Category name..." required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="form_edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.category-update') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" name="slug_category" value="" id="slug_category">
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" id="name_edit" placeholder="Category name..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Slug</label>
                    <input type="text" readonly class="form-control" name="slug" id="slug_edit" placeholder="Slug..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Color</label>
                    <input class="form-control" type="color" name="color" id="color_edit" placeholder="Category name..." required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    const name = document.querySelector('#name');
    const nameEdit = document.querySelector('#name_edit');
    name.addEventListener('blur', (e) => {
        const slug = document.querySelector('#slug');
         let valueTitle = e.target.value.toString().toLowerCase()
                                                    .replace(/^-+/, '')
                                                    .replace(/-+$/, '')
                                                    .replace(/\s+/g, '-')
                                                    .replace(/\-\-+/g, '-')
                                                    .replace(/[^\w\-]+/g, '');
        slug.value = valueTitle;
    });
    nameEdit.addEventListener('blur', (e) => {
        const slug = document.querySelector('#slug_edit');
         let valueTitle = e.target.value.toString().toLowerCase()
                                                    .replace(/^-+/, '')
                                                    .replace(/-+$/, '')
                                                    .replace(/\s+/g, '-')
                                                    .replace(/\-\-+/g, '-')
                                                    .replace(/[^\w\-]+/g, '');
        slug.value = valueTitle;
    });
    const buttonEdit = document.querySelectorAll('.button-edit');

    buttonEdit.forEach(element => {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            const slugCategory = e.target.id;
            fetch(`/admin/category/get/${slugCategory}`, {
                method: 'GET'
            }).then(response => response.json())
            .then(data => {
                if(data.message === 'success') {
                    document.querySelector('#name_edit').value = data.category.name;
                    document.querySelector('#slug_edit').value = data.category.slug;
                    document.querySelector('#color_edit').value = data.category.color;
                    document.querySelector('#slug_category').value = slugCategory;
                }
            })
        })
    });
</script>
@endsection