@extends('layoutDash.main');

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
                            <li class="breadcrumb-item"><a href="{{route('guru.index')}}">Data Guru</a></li>
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
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="guruForm" action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row ">
                            <div class="col-md-12">
                                <div class="text-center alert alert-secondary" role="alert">
                                    Data diri
                                </div>
                            </div>

                            {{-- grup-1 --}}
                            <div class="col-md-6 row ">

                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile">Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" id="inputFoto" accept="image/*">
                                        </div>
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="previewContainer">
                                        <img id="previewFoto" src="#" alt="Preview Foto"
                                             style="max-width: 200px; max-height: 150px;">
                                    </div>
                                </div>

                                <div class="form-group col-md-5 mt-2">
                                    <label for="exampleInputEmail1">Nama Guru</label>
                                    <input type="text" name="nama_guru" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Nama..." value="{{old('nama_guru')}}">
                                    @error('emaiguru mapell')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Data Tempat Lahir..." value="{{old('tempat_lahir')}}">
                                    @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Data Tanggal Lahir..."
                                           value="{{old('tanggal_lahir')}}">
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Email..." value="{{old('email')}}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5 ">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" name="password" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Password..." value="{{old('password')}}">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Nomor Telepon</label>
                                    <input type="number" name="nomor_telepon" class="form-control"
                                           id="exampleInputEmail1" placeholder="Masukkan Nomor Telepon..."
                                           value="{{old('nomor_telepon')}}">
                                    @error('nomor_telepon')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5 ">
                                    <label for="exampleInputEmail1">Nomor Hp</label>
                                    <input type="number" name="nomor_hp" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Nomor Hp..." value="{{old('nomor_hp')}}">
                                    @error('nomor_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Agama</label>
                                    <select name="agama" class="custom-select form-control" id="exampleSelectBorder">
                                        <option readonly>Masukkan Data Agama...</option>
                                        <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>
                                            Kristen
                                        </option>
                                        <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="budha" {{ old('agama') == 'budha' ? 'selected' : '' }}>Budha
                                        </option>
                                        <option value="khongucu" {{ old('agama') == 'khongucu' ? 'selected' : '' }}>
                                            Khongucu
                                        </option>
                                    </select>
                                    @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleSelectBorder">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                        <option readonly>Pilih Jenis Kelamin...</option>
                                        <option
                                            value="laki laki" {{ old('jenis_kelamin') == 'laki laki' ? 'selected' : '' }}>
                                            laki laki
                                        </option>
                                        <option
                                            value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                            perempuan
                                        </option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            {{-- end grup 1 --}}

                            <div class="col-md-6 row  mt-2">

                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Nomor NPWP</label>
                                    <input type="text" name="nomor_npwp" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Nomor NPWP..." value="{{old('nomor_npwp')}}">
                                    @error('nomor_npwp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>

                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Data NIK..." value="{{old('nik')}}">
                                    @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">No. KK</label>
                                    <input type="text" name="no_kk" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Data Nomor KK..." value="{{old('no_kk')}}">
                                    @error('no_kk')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control"
                                           id="exampleInputEmail1" placeholder="Masukkan Gelar Depan..."
                                           value="{{old('gelar_depan')}}">
                                    @error('gelar_depan')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: boleh kosong</span>

                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="exampleInputEmail1">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control"
                                           id="exampleInputEmail1" placeholder="Masukkan Gelar Belakang..."
                                           value="{{old('gelar_belakang')}}">
                                    @error('gelar_belakang')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: boleh kosong</span>

                                </div>

                                <div class=" col-md-12 mt-3">
                                    <label for="" class="">Pendidikan Terakhir</label>
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Jenjang (contoh: Sarjana (S1))</label>
                                    <input type="text" name="jenjang" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Jenjang..." value="{{old('jenjang')}}">
                                    @error('jenjang')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="form-control"
                                           id="exampleInputEmail1" placeholder="Masukkan Tahun Lulus..."
                                           value="{{old('tahun_lulus')}}">
                                    @error('tahun_lulus')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" id="exampleInputEmail1"
                                           placeholder="Masukkan Jurusan..." value="{{old('jurusan')}}">
                                    @error('jurusan')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="text-center alert alert-info" role="alert">
                                    Jabatan & Tugas
                                </div>
                            </div>

                            <div class="col-md-12 row ">
                                <div class="form-group col-md-4 ">
                                    <label for="level">Level</label>
                                    <select name="level" class="custom-select form-control"
                                            id="level">
                                        <option readonly selected>Masukkan Peran Pengguna...</option>
                                        <option
                                            value="kepala sekolah" {{ old('level') == 'kepala sekolah' ? 'selected' : '' }}>
                                            Kepala Sekolah
                                        </option>
                                        <option value="tata usaha" {{ old('level') == 'tata usaha' ? 'selected' : '' }}>
                                            Tata Usaha
                                        </option>
                                        <option value="wali kelas" {{ old('level') == 'wali kelas' ? 'selected' : '' }}>
                                            Wali Kelas
                                        </option>
                                        <option value="guru mapel" {{ old('level') == 'guru mapel' ? 'selected' : '' }}>
                                            Guru Mapel
                                        </option>
                                    </select>
                                    @error('level')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleSelectBorder">Kelas</label>
                                    <select name="kelas_id" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                        <option readonly>Masukkan kelas...</option>
                                        @foreach ($kelas as $class)
                                            @if ($class->angka_kelas < 7)
                                                <option
                                                    value="{{ $class->id }}" {{ old('kelas_id') == $class->id ? 'selected' : '' }}>{{ $class->angka_kelas }}</option>
                                            @elseif($class->angka_kelas > 7)
                                                <option
                                                    value="{{ $class->id }}" {{ old('kelas_id') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- <div class="col-md-6 row">
                               <div class="form-group col-md-6">
                                      <label for="exampleSelectBorder">Role</label>
                                      <select name="role" class="custom-select form-control"
                                          id="exampleSelectBorder">
                                          <option readonly >Masukkan Peran Pengguna...</option>
                                          <option value="kepala sekolah" {{ old('role') == 'kepala sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                          <option value="tata usaha" {{ old('role') == 'tata usaha' ? 'selected' : '' }}>Tata Usaha</option>
                                          <option value="wali kelas" {{ old('role') == 'wali kelas' ? 'selected' : '' }}>Wali Kelas</option>
                                          <option value="guru mapel" {{ old('role') == 'guru mapel' ? 'selected' : '' }}>Guru Mapel</option>
                                      </select>
                                      @error('role')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                  </div> --}}

                                <div class="form-group col-md-4">
                                    <label for="exampleSelectBorder">Status</label>
                                    <select name="status" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                        <option readonly>Masukkan status akun...</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="non aktif" {{ old('status') == 'non aktif' ? 'selected' : '' }}>
                                            Non Aktif
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('guru.index') }}" class="btn btn-secondary">Back</a>
                            <button type="button" class="btn btn-info" onclick="confirmSubmit()">Submit</button>
                            <button type="reset" class="btn btn-danger float-right">reset</button>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </section>
    </div>

    <script>
        const inputFoto = document.getElementById('inputFoto');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function () {
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
                title: 'Tambah Data Guru',
                text: 'Apakah data sudah selesai diisi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('guruForm').submit();
                }
            });
        }
    </script>
@endsection
