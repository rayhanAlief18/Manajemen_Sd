@extends('layoutDash.main');

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Nav Page -->
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                            <li class="breadcrumb-item"><a>Show Barang</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif

                <!-- General Form Input Start-->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form {{$title}}</h3>
                    </div>

                    <!-- Form Start -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label for="nama">Nama Barang</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="normal">Jumlah Normal</label>
                                <input type="number" class="form-control" id="normal" name="normal" value="{{ $barang->normal }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="rusak">Jumlah Rusak</label>
                                <input type="number" class="form-control" id="rusak" name="rusak" value="{{ $barang->rusak }}" readonly>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" readonly>{{ $barang->deskripsi }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                        <!-- Button End -->
                    </form> <!-- End Form -->
                </div> <!-- General Form Input End -->
            </div> <!-- Container End -->
        </section>
        <!-- /.content -->
    </div>
@endsection
