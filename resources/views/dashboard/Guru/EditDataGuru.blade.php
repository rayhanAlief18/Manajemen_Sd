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
                    <form action="{{ route('guru.update', $DataGuru->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                        <img src="{{ asset('storage/guru/' . $DataGuru->foto) }}" alt="Foto Guru"
                                        style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>

                                <div class="form-group col-md-5 mt-2">
                                    <label for="exampleInputEmail1">Nama Guru</label>
                                    <input type="text" name="nama_guru" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Nama..." value="{{$DataGuru->nama_guru}}">
                                        @error('nama_guru')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Data Tempat Lahir..." value="{{$DataGuru->tempat_lahir}}">
                                    @error('tempat_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Data Tanggal Lahir..." value="{{$DataGuru->tanggal_lahir}}">
                                    @error('tanggal_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Email..." value="{{$DataGuru->email}}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-5 ">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Password..." value="{{$DataGuru->password}}" readonly>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Nomor Telepon</label>
                                    <input type="number" name="nomor_telepon" class="form-control"
                                        id="exampleInputEmail1" placeholder="Masukkan Nomor Telepon..." value="{{$DataGuru->nomor_telepon}}">
                                        @error('nomor_telepon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5 ">
                                    <label for="exampleInputEmail1">Nomor Hp</label>
                                    <input type="number" name="nomor_hp" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Nomor Hp..." value="{{$DataGuru->nomor_hp}}">
                                        @error('nomor_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Agama</label>
                                    <select name="agama" class="custom-select form-control" id="exampleSelectBorder">
                                        <option readonly >Masukkan Data Agama...</option>
                                        <option value="islam" {{ $DataGuru->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="kristen" {{ $DataGuru->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="hindu" {{ $DataGuru->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="budha" {{ $DataGuru->agama == 'budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="khongucu" {{ $DataGuru->agama == 'khongucu' ? 'selected' : '' }}>Khongucu</option>
                                    </select>
                                    @error('agama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleSelectBorder">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="custom-select form-control"
                                        id="exampleSelectBorder">
                                        <option readonly >Pilih Jenis Kelamin...</option>
                                        <option value="laki laki" {{ $DataGuru->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>laki laki</option>
                                        <option value="perempuan" {{ $DataGuru->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>perempuan</option>
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
                                        placeholder="Masukkan Nomor NPWP..." value="{{$DataGuru->nomor_npwp}}">
                                        @error('nomor_npwp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>

                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Data NIK..." value="{{$DataGuru->nik}}">
                                        @error('nik')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">No. KK</label>
                                    <input type="text" name="no_kk" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Data Nomor KK..." value="{{$DataGuru->no_kk}}">
                                        @error('no_kk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: harus terdiri dari 16 digit angka</span>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control"
                                        id="exampleInputEmail1" placeholder="Masukkan Gelar Depan..." value="{{$DataGuru->gelar_depan}}">
                                        @error('gelar_depan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: boleh kosong</span>
                                    
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="exampleInputEmail1">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control"
                                        id="exampleInputEmail1" placeholder="Masukkan Gelar Belakang..." value="{{$DataGuru->gelar_belakang}}">
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
                                    <input type="text " name="jenjang" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Jenjang..." value="{{$DataGuru->jenjang}}">
                                        @error('jenjang')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="form-control"
                                        id="exampleInputEmail1" placeholder="Masukkan Tahun Lulus..." value="{{$DataGuru->tahun_lulus}}">
                                        @error('tahun_lulus')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Jurusan..." value="{{$DataGuru->jurusan}}}">
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
                                                <option value="kepala sekolah" {{ $DataGuru->level == 'kepala sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                                <option value="tata usaha" {{ $DataGuru->level == 'tata usaha' ? 'selected' : '' }}>Tata Usaha</option>
                                                <option value="wali kelas" {{ $DataGuru->level == 'wali kelas' ? 'selected' : '' }}>Wali Kelas</option>
                                                <option value="guru mapel" {{ $DataGuru->level == 'guru mapel' ? 'selected' : '' }}>Guru Mapel</option>
                                            </select>
                                            @error('level')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleSelectBorder">Kelas</label>
                                        <select name="kelas_id" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                            <option readonly >Masukkan kelas...</option>
                                            @foreach ($kelas as $class)
                                                @if ($class->angka_kelas < 7)
                                                    <option value="{{ $class->id }}" {{$DataGuru->angka_kelas == $class->id ? 'selected' : '' }}>{{ $class->angka_kelas }}</option>
                                                @elseif($class->angka_kelas > 7)
                                                @endif
                                                @endforeach
                                                    <option value="8" {{$DataGuru->angka_kelas == 8 ? 'selected' : '' }}>Tidak Memiliki Kelas (untuk guru yang tidak mengampu kelas)</option>
                                                    <option value="9" {{$DataGuru->angka_kelas == 9 ? 'selected' : '' }}>Tidak Memiliki Kelas Tetap (Untuk guru mapel yang tidak memiliki kelas tetap)</option>
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
                                            <option readonly >Masukkan status akun...</option>
                                            <option value="aktif" {{ $DataGuru->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="non aktif" {{ $DataGuru->status == 'non aktif' ? 'selected' : '' }}>Non Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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
