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
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label for="nisn">NISN</label>
                                <input type="number" name="NISN" class="form-control" id="nisn"
                                    value="{{ $siswa->NISN }}" placeholder="Masukkan NISN..." readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" id="exampleInputEmail1"
                                    value="{{ $siswa->nama_siswa }}" placeholder="Masukkan Nama Guru...">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    value="{{ $siswa->tanggal_lahir }}" placeholder="Masukkan Jenis Kelamin...">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="wali_siswa">Wali Siswa</label>
                                <input type="text" name="wali_siswa" class="form-control" id="wali_siswa"
                                    value="{{ $siswa->wali_siswa }}" placeholder="Masukkan Wali Siswa...">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="laki" {{ $siswa->jenis_kelamin == 'laki' ? 'selected' : '' }}>Laki-Laki
                                    </option>
                                    <option value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" class="custom-select form-control" id="kelas">
                                    @foreach ($kelas as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $siswa->kelas_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="foto_siswa" type="file" id="inputFoto" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <img id="previewFoto" src="{{ asset('storage/siswa/'.$siswa->foto_siswa) }}" alt="Foto Siswa"
                                    style="max-width: 300px; max-height: 300px;">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-danger float-right">reset</button>
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
