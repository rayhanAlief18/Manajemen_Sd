@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('matapelajaran.index')}}">Mata Pelajaran</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif

                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="mapelForm" action="{{ route('matapelajaran.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="exampleSelectBorder">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" name="nama_pelajaran"
                                           placeholder="Masukkan Nama Pelajaran..."
                                           value="{{old('nama_pelajaran')}}">
                                    @error('nama_pelajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleSelectBorder">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control" name="kd_pelajaran"
                                           placeholder="Masukkan Kode Mata Pelajaran..."
                                           value="{{old('kd_pelajaran')}}">
                                    @error('kd_pelajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('matapelajaran.index') }}" class="btn btn-outline-secondary">Back</a>
                            <button type="button" class="btn btn-info float-right" onclick="confirmSubmit()">Save</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- JS Code -->
    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Tambah Data Mata Pelajaran',
                text: 'Apakah data sudah selesai diisi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('mapelForm').submit();
                }
            });
        }
    </script>
    <!-- End JS Code -->
@endsection
