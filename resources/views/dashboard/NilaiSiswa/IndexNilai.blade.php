@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title2 }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if (session('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                <div class="row col-md-12">
                    @foreach ($kelass as $kelass)
                        @if ($kelass->angka_kelas <= 6)
                            @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                @if (Auth::guard('guru')->user()->kelas_id == $kelass->id)
                                    <!-- small box -->
                                    {{-- <div class="col-lg-3 col-6">
                                    <a class="link-kelas" href="{{ route('DaftarKelas') }}">
                                    <a href="{{ route('DaftarKelas', $kelass->id) }}">
                                        <div class="small-box py-3">
                                            <div class="inner p-4">
                                                <h4 class="mb-0">{{ $kelass->nama_kelas }}</h4>
                                                <p class="mb-0">Jumlah Siswa : {{ $kelass->siswa_count }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                    <!-- small box -->
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $kelass->nama_kelas }}</h3>

                                                <p>Wali kelas: {{ $kelass->nama_guru }}</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                           
                                            <a href="{{ route('DaftarKelas', $kelass->id) }}" class="small-box-footer">More
                                                info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                            </div>
                @endif
                @endif
                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $kelass->nama_kelas }}</h3>

                            <p>Jumlah Siswa: {{ $kelass->siswa_count }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('DaftarKelas', $kelass->id) }}" class="small-box-footer">More
                            info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    {{-- TOOLTIP TOOLS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap 4.6 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="path/to/adminlte.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
