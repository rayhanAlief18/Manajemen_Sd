@extends('layoutDash.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div> --}}
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid mt-4">
                @if ($errors->any())
                    {{-- @foreach ($errors->all() as $error) --}}
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Kesalahan! </strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    {{-- @endforeach --}}
                @endif
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h2 class="card-title">{{ $title }}</h2>
                    </div>



                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('nilai.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-sm-4">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" value="{{ $data->siswa->nama_siswa }}" class="form-control"
                                    id="nama_siswa" readonly>
                                   
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nama_siswa">Semester</label>
                                <input type="text" value="{{ $data->semester }}" class="form-control" id="nama_siswa"
                                    readonly>
                                   
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="kategori">Semester</label>
                                @if ($data->kategori == 'uts')
                                    <input type="text" value="UTS / PTS" class="form-control" id="kategori" readonly>
                                @elseif ($data->kategori == 'uas')
                                    <input type="text" value="UAS / PAS" class="form-control" id="kategori" readonly>
                                @endif
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="nilai">Nilai</label>
                                <input type="number" value="{{ $data->nilai }}" name="nilai" class="form-control"
                                    id="nilai" placeholder="Masukkan Nilai" min="0">
                                    @error('nilai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="catatan">Catatan</label>
                                <input type="text" value="{{ $data->catatan}}" name="catatan" class="form-control" id="catatan"
                                    placeholder="Masukkan Catatan">
                                    @error('catatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="window.history.back();">Kembali</button>
                        </div>
                    </form>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const inputFoto = document.getElementById('inputFoto');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewFoto.src = reader.result;
                });

                reader.readAsDataURL(file);
            } else {
                previewFoto.src = ""; // Reset gambar
                previewFoto.style.display = 'none'; // Sembunyikan gambar
            }
        });
    </script>
@endsection
