@extends('admin.layouts.main')
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
@endpush
@section('content-admin')
<div class="container-fluid">
    @if(session()->has('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('Error'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ session('Error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-6">
            <h1 class="h3 m-0">Social Media</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-backspace-fill"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 my-3">
            <div class="card p-3">
                <div class="card-body">
                    @foreach($socialmedia as $social)
                    <div class="row">
                        <div class="col-2">
                            <i class="{{ $social->icon }}" style="font-size: 3em;"></i>
                        </div>
                        <div class="col-6 border-left">
                            <a href="">{{ $social->url }}</a>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="{{ $social->isSelected == 1 ? 'text-success' : 'text-danger' }} label">{{ $social->isSelected == 1 ? 'Active' : 'Disable' }}</label>
                                    <input id="{{ $social->id }}" type="range" value="{{ $social->isSelected == 1 ? 1 : 0 }}"  max="1" class="mx-2 is_selected" style="width: 30px;">
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary btn-sm button-edit" data-toggle="modal" data-target="#modal-edit" data-id-social="{{ $social->id }}">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('admin.update-social') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Social Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="url_social" class="form-label">URL Social Media</label>
                        <input type="hidden" id="hidden_id" name="id_social">
                        <input class="form-control" type="url" name="url_social" id="url_social">
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
@push('script-edit-social')
<script>
    const buttonEdit = document.querySelectorAll('.button-edit');
    buttonEdit.forEach(element => {
        element.addEventListener('click', (e) => {
            if(e.target.getAttribute('data-id-social') === element.getAttribute('data-id-social')) {
                const idSocial = e.target.getAttribute('data-id-social');
                console.log(idSocial);
                getDataSocial(idSocial)
            }
        })
    })

    function getDataSocial(id) {
         fetch('/api/admin/get-social/' + id, {
            method: 'GET'
         })
         .then(response => response.json())
         .then(data => {
            const inputURL = document.querySelector('#url_social');
            const hiddenId = document.querySelector('#hidden_id');
            console.log(data)
            hiddenId.setAttribute('value', data.social.id);
            inputURL.setAttribute('value', data.social.url);
         })
        
    }
</script>
@endpush
<script>
    const isSelected = document.querySelectorAll('.is_selected');

    isSelected.forEach((element, i) => {
        element.addEventListener('change', (e) => {
            const label = document.querySelectorAll('.label');
            const formData = new FormData();
            const _token = '{{ csrf_token() }}';
            const valueRange = e.target.value;
            const idRange = e.target.id;
            formData.append('value', valueRange);
            formData.append('id_social', idRange);
            fetch(`{{ route('admin.api-socialmedia') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                credential: 'same-origin',
                body: formData
            }).then(response => response.json())
            .then(data => {
                if(data.message === 'success') {
                    e.target.value = data.value;
                    if(data.value == 1) {
                        label[i].textContent = 'Active';
                        label[i].classList.add('text-success');
                        label[i].classList.remove('text-danger');
                    }else {
                        label[i].textContent = 'Disable';
                        label[i].classList.add('text-danger');
                        label[i].classList.remove('text-success');
                    }
                }
            })

        })
    });
</script>
@endsection