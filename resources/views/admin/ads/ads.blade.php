@extends('admin.layouts.main')
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
@endpush
@section('content-admin')
<style>
    .ads-sidebar {
        width: 100%;
        min-height: 150px;
        border: 1px solid rgb(226, 220, 220);
        background-color: rgb(245, 245, 245);position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        filter: drop-shadow(3px 5px 7px rgba(39, 39, 39, 0.253))
    }
    .ads-content {
        width: 100%;
        min-height: 100px;
        border: 1px solid rgb(226, 220, 220);
        background-color: rgb(245, 245, 245);
        filter: drop-shadow(3px 5px 7px rgba(39, 39, 39, 0.253));
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .ads-header {
        width: 100%;
        min-height: 80px;
        border: 1px solid rgb(226, 220, 220);
        background-color: rgb(245, 245, 245);
        filter: drop-shadow(3px 5px 7px rgba(39, 39, 39, 0.253));
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .input-ads {
        width: 100%;
        height: 100%;
        opacity: 0;
        position: absolute;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">Setting Ads</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h5 m-0">List Ads</h3>
                </div>
                <div class="card-body">
                    <div class="row mt-3" id="ads-setting">
                        @foreach($ads as $a)
                            <div class="col-lg-{{ $a->col }}">
                                <p class="text-center text-primary" style="text-transform: capitalize;">Ads {{ $a->type }}</p>
                                <div class="ads-{{ $a->type }}">
                                    <input type="file" class="input-ads" data-type-ads="{{ $a->type }}">
                                    <img width="100%" src="{{ $a->thumb !== null ? "/assets/blog/img/ads/{$a->thumb}" : "" }}" alt="" class="image-ads"
                                        @if($a->type == 'sidebar')
                                            height="150"
                                        @elseif($a->type == 'content')
                                            height="90"
                                        @else 
                                            height="90"
                                        @endif
                                    >
                                    <b>Upload Image</b>
                                    <i class="bi bi-card-image"></i>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center m-2">
                                        <input id="{{ $a->type }}" type="range" value="{{ $a->status }}"  max="1" class="mx-2 is_selected" style="width: 30px;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Type Ads</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Clicks</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ads as $a)
                                            <tr>
                                                <td>
                                                    <img width="100" src="{{ $a->thumb !== null ? "/assets/blog/img/ads/{$a->thumb}" : "" }}" alt="">
                                                </td>
                                                <td>{{ $a->title }}</td>
                                                <td><a href="">{{ $a->link }}</a></td>
                                                <td>20</td>
                                                <td>50</td>
                                                <td><b class="text-status {{ $a->status > 0 ? 'text-success' : 'text-danger' }}">{{ $a->status > 0 ? 'Active' : 'Disable' }}</b></td>
                                                <td>
                                                    <button data-type-ads="{{ $a->type }}" type="button" class="btn btn-sm btn-primary button-edit-ads" data-toggle="modal" data-target="#modal-edit-ads">Edit</button>
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
    </div>
</div>
<div class="modal fade" tabindex="-1" id="modal-edit-ads">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('admin.update-ads') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Ads</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title Ads</label>
                        <input type="hidden" id="hidden_id" name="type_ads">
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title Ads">
                    </div>
                    <div class="col-12">
                        <label for="link" class="form-label">Link</label>
                        <input class="form-control" type="url" name="link" id="link" placeholder="Link Ads">
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
@push('script-upload') 
    {{-- <script>
    const inputUpload = document.querySelector('#file_upload');
    
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
</script> --}}
@endpush
{{-- <script src="{{ asset('assets/blog/js/resize_image.js') }}"></script> --}}
<script>
    const WIDTH = 500;
    const inputAds = document.querySelector('#ads-setting');
    
    const __token = '{{ csrf_token() }}';
    const route = `{{ route('admin.api-upload-thumb-ads') }}`;
    inputAds.addEventListener('click', (e) => {
        if(e.target.className == 'input-ads') {
            e.target.addEventListener('change', (event) => {
                const typeAds = event.target.getAttribute('data-type-ads');
                const image = event.target.nextElementSibling;
                const imgFile = event.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(imgFile);
                reader.onload = (ev) => {
                    const imageUrl = ev.target.result;
                    const img = document.createElement('img');
                    img.src = imageUrl;
                    img.onload = (e) => {
                        const canvas = document.createElement('canvas');
                        canvas.width = WIDTH;
                        const ratio = WIDTH / e.target.width;
                        canvas.height = e.target.height * ratio;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        const newImageUrl = ctx.canvas.toDataURL('image/jpeg', 80);
                        const newImage = document.createElement('img');
                        newImage.src = newImageUrl;
                        image.src = newImageUrl;
                        canvas.toBlob(function(blob) {
                            const newFileImage = new File([blob], imgFile.name, {
                                type: blob.type
                            });
                            console.log(newFileImage)
                            console.log(canvas)
                            const imageFile = new FormData();
                        imageFile.append('file', newFileImage);
                        imageFile.append('type', typeAds);
                        upload_logo(route, __token, imageFile);
                        })
                        
                    }
                }
                
                // const srcImage = URL.createObjectURL(event.target.files[0]);
                // image.src = srcImage;
                
            })
        }
    })

    const buttonEditAds = document.querySelectorAll('.button-edit-ads');
    buttonEditAds.forEach(e => {
        e.addEventListener('click', (event) => {
            const typeAds = event.target.getAttribute('data-type-ads');
            getDataAds(typeAds);
        })
    })

    function upload_logo (url, token, imageFile) {
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
                // const notifUploadLogo = document.querySelector(notif);
                console.log(data)
            
            }
        })
    }
    function getDataAds(type) {
         fetch('/api/admin/get-ads/' + type, {
            method: 'GET'
         })
         .then(response => response.json())
         .then(data => {
            if(data.status) {
                document.querySelector('#title').value = data.ads.title;
                document.querySelector('#link').value = data.ads.link;
                document.querySelector('#hidden_id').value = type;
            }
            
         })
         .catch(err => console.log(err))
        
    }

    const inputRange = document.querySelectorAll('.is_selected');

    inputRange.forEach((element, i) => {
        element.addEventListener('change', (e) => {
            const label = document.querySelectorAll('.text-status');
            const formData = new FormData();
            const _token = '{{ csrf_token() }}';
            const valueRange = e.target.value;
            const idRange = e.target.id;
            formData.append('value', valueRange);
            formData.append('type_ads', idRange);
            fetch(`{{ route('admin.api-update-status-ads') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                credential: 'same-origin',
                body: formData
            }).then(response => response.json())
            .then(data => {
                if(data.status) {
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
{{-- <script>
    const inputAds = document.querySelector('#ads-setting');
    inputAds.addEventListener('click', (e) => {
        if(e.target.className == 'input-ads') {
            e.target.addEventListener('change', (event) => {
                const image = event.target.nextElementSibling;
                const typeAds = event.target.getAttribute('data-type-ads');
                const __token = '{{ csrf_token() }}';
                const route = `{{ route('admin.api-upload-thumb-ads') }}`;
                const imgFile = event.target.files[0];
                const urlBlob = window.URL.createObjectURL(imgFile);
                const img = new Image();
                console.log(img)
                img.src = urlBlob;
                image.src = urlBlob;
                const canvas = document.createElement('canvas');
                canvas.width = image.width;
                canvas.height = image.height;
                const ctx = canvas.getContext('2d');
                img.onload = function(even) {
                    ctx.drawImage(img, 0, 0, 300, 300)
                }
                const imgType = image.mimeType;
                const quality = 50;
                const imageFile = new FormData();
                canvas.toBlob(function(blob) {
                    const fileImg = new File([blob], imgFile.name, {
                        type: blob.type
                    });
                    console.log(blob)
                     console.log(fileImg)
                     imageFile.append('file', fileImg);
                     imageFile.append('type', typeAds);
                     upload_logo(route, __token, imageFile);
                    // const srcImage = URL.createObjectURL(event.target.files[0]);
                    // image.src = srcImage;
                }, imgType, quality);
                // imageFile.append('file', blob);
                //      imageFile.append('type', typeAds);
                //      upload_logo(route, __token, imageFile);
               
            })
        }
    })

    const buttonEditAds = document.querySelectorAll('.button-edit-ads');
    buttonEditAds.forEach(e => {
        e.addEventListener('click', (event) => {
            const typeAds = event.target.getAttribute('data-type-ads');
            getDataAds(typeAds);
        })
    })

    function upload_logo (url, token, imageFile) {
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
                // const notifUploadLogo = document.querySelector(notif);
                console.log(data)
            
            }
        })
    }
    function getDataAds(type) {
         fetch('/api/admin/get-ads/' + type, {
            method: 'GET'
         })
         .then(response => response.json())
         .then(data => {
            if(data.status) {
                document.querySelector('#title').value = data.ads.title;
                document.querySelector('#link').value = data.ads.link;
                document.querySelector('#hidden_id').value = type;
            }
            
         })
         .catch(err => console.log(err))
        
    }

    const inputRange = document.querySelectorAll('.is_selected');

    inputRange.forEach((element, i) => {
        element.addEventListener('change', (e) => {
            const label = document.querySelectorAll('.text-status');
            const formData = new FormData();
            const _token = '{{ csrf_token() }}';
            const valueRange = e.target.value;
            const idRange = e.target.id;
            formData.append('value', valueRange);
            formData.append('type_ads', idRange);
            fetch(`{{ route('admin.api-update-status-ads') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                credential: 'same-origin',
                body: formData
            }).then(response => response.json())
            .then(data => {
                if(data.status) {
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
</script> --}}
@endsection