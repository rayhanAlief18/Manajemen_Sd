@extends('layoutDash.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
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
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-sm-4">
                                <label for="nik">NIK</label>
                                <input type="number" name="NIK" class="form-control" id="nik"
                                    placeholder="Masukkan NIK...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nik">NO KK (Kartu Keluarga)</label>
                                <input type="number" name="NO_KK" class="form-control" id="nik"
                                    placeholder="Masukkan NO_KK...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nis">NIS</label>
                                <input type="number" name="NIS" class="form-control" id="nis"
                                    placeholder="Masukkan NIS...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nisn">NISN</label>
                                <input type="number" name="NISN" class="form-control" id="nisn"
                                    placeholder="Masukkan NISN...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" id="nama_siswa"
                                    placeholder="Masukkan Nama Siswa...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    placeholder="Masukkan Jenis Kelamin...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="wali_siswa">Ortu / Wali Siswa</label>
                                <input type="text" name="wali_siswa" class="form-control" id="wali_siswa"
                                    placeholder="Masukkan Wali Siswa...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="agama">Agama</label>
                                <input type="text" name="agama" class="form-control" id="agama"
                                    placeholder="Masukkan Agama...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tempat">Tempat</label>
                                <input type="text" name="tempat" class="form-control" id="tempat"
                                    placeholder="Masukkan Tempat Tinggal...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="anak_ke">Anak Ke</label>
                                <input type="number" name="anak_ke" class="form-control" id="anak_ke"
                                    placeholder="Masukkan Anak Ke...">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleSelectBorder">Kelas</label>
                                <select name="kelas" class="form-control" id="exampleSelectBorder">
                                    @foreach ($kelas as $class)
                                        <option name="kelas" value="{{ $class->id }}" selected>{{ $class->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="foto_siswa">Foto Siswa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="foto_siswa" type="file" id="foto_siswa" multiple>
                                    </div>
                                </div>
                            </div>

                            <div id="previewContainer">
                                <img id="previewFoto" src="#" alt="Preview Foto"
                                    style="max-width: 300px; max-height: 300px;">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back();">Kembali</button>
                            {{-- <button type="reset" class="btn btn-danger float-right">reset</button> --}}
                        </div>
                    </form>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const inputFoto = document.getElementById('foto_siswa');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewFoto.src = reader.result;
                    previewFoto.style.display = 'block'; // Menampilkan gambar setelah dipilih
                });

                reader.readAsDataURL(file);
            } else {
                previewFoto.src = ""; // Reset gambar
                previewFoto.style.display = 'none'; // Sembunyikan gambar
            }
        });
    </script>
@endsection
