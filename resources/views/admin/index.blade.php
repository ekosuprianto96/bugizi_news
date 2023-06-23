@extends('admin.layouts.main')
@push('jquery')
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
@endpush
@section('content-admin')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                New Comments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Comment::whereDay('created_at', Carbon\carbon::now()->format('d'))->whereMonth('created_at', Carbon\carbon::now()->format('m'))->whereYear('created_at', Carbon\carbon::now()->format('Y'))->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                New Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Visitor::whereDay('created_at', Carbon\carbon::now()->format('d'))->whereMonth('created_at', Carbon\carbon::now()->format('m'))->whereYear('created_at', Carbon\carbon::now()->format('Y'))->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengunjung Hari Ini
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ App\Models\ViewsPost::whereDay('created_at', Carbon\carbon::now()->format('d'))->whereMonth('created_at', Carbon\carbon::now()->format('m'))->whereYear('created_at', Carbon\carbon::now()->format('Y'))->count() }}</div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-eye-fill" style="font-size: 2em;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Analitycs Pengunjung & Pengguna</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">10 Postingan Terpopuler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ThumbNail</th>
                                    <th>Title</th>
                                    <th>Excerpt</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($post_populer as $pop)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <img src="{{ asset('assets/blog/img/thumb_post/') }}/{{ $pop->thumbnail_post }}" alt="Thumbnail Post" width="80">
                                    </td>
                                    <td style="white-space: nowrap;max-width: 200px;overflow:hidden;text-overflow:ellipsis;">{{ $pop->title }}</td>
                                    <td style="white-space: nowrap;max-width: 200px;overflow:hidden;text-overflow:ellipsis;">{{ $pop->excerpt }}</td>
                                    <td>{{ $pop->category->name }}</td>
                                    <td>{{ $pop->views_post_count }}</td>
                                    <td>{{ $pop->comments_count }}</td>
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
@push('chart')
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endpush
<!-- /.container-fluid -->
@endsection

