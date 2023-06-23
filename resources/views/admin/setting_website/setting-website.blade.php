@extends('admin.layouts.main')
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
@endpush
@section('content-admin')
<style>
    #file_upload {
        position: absolute;
        bottom: 0;
        opacity: 0;
        z-index: 3;
    }
    #file_upload_admin {
        position: absolute;
        bottom: 0;
        opacity: 0;
        z-index: 3;
    }
    #icon-camera {
        position: absolute;
        bottom: 0;
        z-index: 2;
        color: white;
    }
    .image-profile {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-profile img {
        position: relative;
        z-index: 1;
    }
    #icon-delete {
        position: absolute;
        top: -10px;
        right: -15px;
        border-radius: 50%;
        background-color: rgb(255, 37, 37);
        padding: 10px;
        z-index: 9999999999999999999999999999;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.8em;
    }
    #icon-delete:hover {
        opacity: 0.7;
        cursor: pointer;
    }
</style>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h1 class="h3 m-0"><i class="bi bi-gear-fill"></i> Setting Website</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h5 text-center">Website</h1>
                            <hr>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <div class="image-profile position-relative" style="width: 100px;height: 100px;">
                                    <span id="icon-delete"><i class="bi bi-trash3-fill text-light"></i></span>
                                    <img class="img-profile rounded-circle w-100"
                                    src="/assets/admin/img/{{ $detail->logo_web === null ? 'undraw_profile_2.svg' : 'logo_img/'.$detail->logo_web}}" id="image_logo">
                                    <input type="file" id="file_upload">
                                    <i class="bi bi-camera-fill" id="icon-camera"></i>
                                </div>
                                <strong>Logo</strong>
                            </div>
                            <div class="row p-4" id="notif-upload-logo"></div>
                            <form action="{{ route('admin.sett-website') }}" method="POST">
                                @csrf
                                <div class="col-12 mb-3">
                                    <label for="aplication_name" class="form-label">Aplication Name :</label>
                                    <input value="{{ $detail['app_name'] }}" class="form-control" type="text" name="application_name" id="application_name">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="applicaton_id" class="form-label">Aplication ID :</label>
                                    <input value="{{ $detail['app_id'] }}" class="form-control" type="text" readonly name="applicaton_id" id="applicaton_id">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-50">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <h1 class="h5 text-center">Admin Profile</h1>
                            <hr>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <div class="image-profile position-relative" style="width: 100px;height: 100px;">
                                    <img class="img-profile rounded-circle w-100"
                                    src="/assets/admin/img/{{ Auth::user()->image === null ? 'undraw_profile_2.svg' : 'admin_img/'.Auth::user()->image}}" id="image-profile-admin">
                                    <input type="file" id="file_upload_admin">
                                    <i class="bi bi-camera-fill" id="icon-camera"></i>
                                </div>
                            </div>
                            <div class="row p-4" id="notif-upload-image-admin"></div>
                            <form action="{{ route('admin.set-profile-admin') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Name :</label>
                                        <input required name="name" value="{{ Auth::user()->name }}" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">User Name :</label>
                                        <input required name="username" value="{{ Auth::user()->username }}" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Email :</label>
                                        <input required name="email" value="{{ Auth::user()->email }}" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">No Handphone :</label>
                                        <input required name="no_handphone" value="{{ Auth::user()->no_handphone }}" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <a href="">Reset Password !</a>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-primary w-50">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script-upload') 
    <script>
    const inputUpload = document.querySelector('#file_upload');
    inputUpload.addEventListener('change', (e) => {
        const image = document.querySelector('#image_logo');
        const __token = '{{ csrf_token() }}';
        const route = `{{ route('admin.api-upload-logo') }}`;
        const imageFile = new FormData();
        imageFile.append('logo', e.target.files[0]);
        const srcImage = URL.createObjectURL(e.target.files[0]);
        image.src = srcImage;
        upload_logo(route, __token, imageFile, '#notif-upload-logo');
    })
    const inputUploadAdmin = document.querySelector('#file_upload_admin');
    inputUploadAdmin.addEventListener('change', (e) => {
        const imageAdmin = document.querySelector('#image-profile-admin');
        const __tokenAdmin = '{{ csrf_token() }}';
        const routeAdmin = `{{ route('admin.api-upload-profile-admin') }}`;
        const imageFileAdmin = new FormData();
        imageFileAdmin.append('image_admin', e.target.files[0]);
        const srcImageAdmin = URL.createObjectURL(e.target.files[0]);
        imageAdmin.src = srcImageAdmin;
        upload_logo(routeAdmin, __tokenAdmin, imageFileAdmin, '#notif-upload-image-admin')
    })
    function upload_logo (url, token, imageFile, notif) {
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin',
            body: imageFile
        }).then(response => response.json())
        .then(data => {
            if(data.status) {
                const notifUploadLogo = document.querySelector(notif);
                notifUploadLogo.innerHTML = `<div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>`
            }
        })
    }
    const btnDeleteLogo = document.querySelector('#icon-delete');
    btnDeleteLogo.addEventListener('click', () => {
        deleteLogo()
    })
    function deleteLogo() {
        fetch(`{{ route('admin.api-delete-logo') }}`, {
            method: 'GET'
        }).then(response => response.json())
        .then(result => {
            if(result.status) {
                document.querySelector('#image_logo').src = '/assets/admin/img/undraw_profile_2.svg';
            }
        })
    }
</script>
@endpush
{{-- @push('js-bootstrap')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@endpush --}}
@endsection