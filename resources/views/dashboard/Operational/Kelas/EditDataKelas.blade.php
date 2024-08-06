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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('kelas.index')}}">Data Kelas</a></li>
                            <li class="breadcrumb-item"><a href="{{route('kelas.show', $kelas_id)}}">Data Siswa Kelas {{$nama_kelas}}</a></li>
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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Kesalahan! </strong> mohon periksa kembali
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h2 class="card-title">{{ $title }}</h2>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="siswaForm" action="{{ route('kelas.update', $siswa->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-sm-4">
                                <label for="exampleInputFile">Foto Siswa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="foto_siswa" type="file" id="inputFoto" accept="image/*">
                                    </div>
                                    @error('foto_siswa')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img id="previewFoto" src="{{ asset('storage/siswa/' . $siswa->foto_siswa) }}"
                                         alt="Foto Siswa" style="max-width: 170px; max-height: 170px;">
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="">
                                    <label for="nik">NIK</label>
                                    <input type="number" name="NIK" class="form-control" id="nik"
                                           value="{{ $siswa->NIK }}" placeholder="Masukkan NIK...">
                                    @error('NIK')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="no_kk">NO KK (Kartu Keluarga)</label>
                                    <input type="number" name="NO_KK" class="form-control" id="no_kk"
                                           value="{{ $siswa->NO_KK }}" placeholder="Masukkan NO_KK...">
                                    @error('NO_KK')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label for="nama_siswa">Nama Lengkap</label>
                                    <input type="text" name="nama_siswa" class="form-control" id="nama_siswa"
                                           value="{{ $siswa->nama_siswa }}" placeholder="Masukkan nama siswa...">
                                    @error('nama_siswa')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="">
                                    <label for="nis">NIS</label>
                                    <input type="number" name="NIS" class="form-control" id="nis"
                                           value="{{ $siswa->NIS }}" placeholder="Masukkan NIS...">
                                    @error('NIS')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="nisn">NISN</label>
                                    <input type="number" name="NISN" class="form-control" id="nisn"
                                           value="{{ $siswa->NISN }}" placeholder="Masukkan NISN...">
                                    @error('NISN')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                           value="{{ $siswa->tanggal_lahir }}" placeholder="Masukkan Jenis Kelamin...">
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="laki" {{ $siswa->jenis_kelamin == 'Laki' ? 'selected' : '' }}>
                                        Laki-Laki
                                    </option>
                                    <option value="perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="wali_siswa">Ortu / Wali Siswa</label>
                                <input type="text" name="wali_siswa" class="form-control" id="wali_siswa"
                                       value="{{ $siswa->wali_siswa }}" placeholder="Masukkan Wali Siswa...">
                                @error('wali_siswa')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleSelectBorder">Agama</label>
                                <select name="agama" class="custom-select form-control" id="exampleSelectBorder">
                                    <option readonly selected>Masukkan Data Agama...</option>
                                    <option value="islam" {{ $siswa->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ $siswa->agama == 'kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="hindu" {{ $siswa->agama == 'hindu' ? 'selected' : '' }}>hindu</option>
                                    <option value="budha" {{ $siswa->agama == 'budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="khongucu" {{ $siswa->agama == 'khongucu' ? 'selected' : '' }}>Khongucu
                                    </option>
                                </select>
                                @error('agama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tempat">Tempat</label>
                                <input type="text" name="tempat" class="form-control" id="tempat"
                                       value="{{ $siswa->tempat }}" placeholder="Masukkan Wali Siswa...">
                                @error('tempat')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="anak_ke">Anak Ke</label>
                                <input type="number" name="anak_ke" class="form-control" id="anak_ke"
                                       value="{{ $siswa->anak_ke }}" placeholder="Masukkan Wali Siswa...">
                                @error('anak_ke')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group col-sm-4">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" class="custom-select form-control" id="kelas">
                                    @foreach ($kelas as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $siswa->kelas_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->angka_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="semester">Semester</label>
                                <select name="semester" class="form-control" id="semester">
                                    <option value="Semester 1" {{ $siswa->semester == 'Semester 1' ? 'selected' : '' }}>
                                        Semester 1
                                    </option>
                                    <option value="Semester 2" {{ $siswa->semester == 'Semester 2' ? 'selected' : '' }}>
                                        Semester 2</option>
                                </select>
                                @error('semester')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group col-sm-4">
                                <label for="anak_ke">Email</label>
                                <input type="text" name="email" class="form-control" id="anak_ke"
                                       value="{{ $siswa->email }}" placeholder="Masukkan Email...">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div><div class="form-group col-sm-4">
                                <label for="anak_ke">Password</label>
                                <input type="text" name="password" class="form-control" id="anak_ke"
                                       value="{{ $siswa->password }}" placeholder="Masukkan Password...">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="{{ route('kelas.show', $kelas_id) }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="button" class="btn btn-info float-right" onclick="confirmSubmit()">Submit</button>
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

        function confirmSubmit() {
            Swal.fire({
                title: 'Ubah Data Siswa',
                text: 'Apakah data sudah selesai diubah?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('siswaForm').submit();
                }
            });
        }
    </script>
@endsection
