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
                                            <input name="image" type="file" id="inputFoto" accept="image/*"
                                                value="awikwok">
                                        </div>
                                    </div>
                                    <div id="previewContainer">
                                        <img id="previewFoto" src="{{ asset('storage/guru/' . $DataGuru->foto) }}"
                                            alt="Preview Foto" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                </div>

                                <div class="form-group col-md-5 mt-2">
                                    <label for="exampleInputEmail1">Nama Guru</label>
                                    <input type="text" name="nama_guru" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->nama_guru }}" placeholder="Masukkan Nama...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->tempat_lahir }}" placeholder="Masukkan Data Tempat Lahir...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->email }}" placeholder="Masukkan Data Tempat Lahir...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Kata Sandi</label>
                                    <input type="text" name="password" disabled class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->password }}" placeholder="Masukkan Data Tempat Lahir...">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->tanggal_lahir }}" placeholder="Masukkan Data Tanggal Lahir...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->nik }}" placeholder="Masukkan Data NIK...">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleInputEmail1">No. KK</label>
                                    <input type="text" name="no_kk" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->no_kk }}" placeholder="Masukkan Data Nomor KK...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Agama</label>
                                    <select name="agama" class="custom-select form-control" id="exampleSelectBorder">
                                        <option readonly selected>Masukkan Data Agama...</option>
                                        <option value="{{ $DataGuru->agama }}" selected>{{ $DataGuru->agama }}</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="hindu">hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="khongucu">Khongucu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="exampleSelectBorder">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="custom-select form-control"
                                        id="exampleSelectBorder">
                                        <option readonly selected>Pilih Jenis Kelamin...</option>
                                        <option value="{{ $DataGuru->jenis_kelamin }}" selected>
                                            {{ $DataGuru->jenis_kelamin }}</option>
                                        <option value="laki laki">laki laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>

                            </div>
                            {{-- end grup 1 --}}

                            <div class="col-md-6 row  mt-2">

                                <div class="form-group col-md-12 ">
                                    <label for="exampleInputEmail1">Nomor NPWP</label>
                                    <input type="text" name="nomor_npwp" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->nomor_npwp }}" placeholder="Masukkan Nomor NPWP...">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control"
                                        id="exampleInputEmail1" value="{{ $DataGuru->gelar_depan }}"
                                        placeholder="Masukkan Gelar Depan...">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control"
                                        id="exampleInputEmail1" value="{{ $DataGuru->gelar_belakang }}"
                                        placeholder="Masukkan Gelar Belakang...">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Nomor Telepon</label>
                                    <input type="number" name="nomor_telepon" class="form-control"
                                        id="exampleInputEmail1" value="{{ $DataGuru->nomor_telepon }}"
                                        placeholder="Masukkan Nomor Telepon...">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Nomor Hp</label>
                                    <input type="number" name="nomor_hp" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->nomor_hp }}" placeholder="Masukkan Nomor Hp...">
                                </div>

                                <div class=" col-md-12 mt-3">
                                    <label for="" class="">Pendidikan Terakhir</label>
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Jenjang (contoh: Sarjana (S1))</label>
                                    <input type="text " name="jenjang" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->jenjang }}" placeholder="Masukkan Jenjang...">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="form-control"
                                        id="exampleInputEmail1" value="{{ $DataGuru->tahun_lulus }}"
                                        placeholder="Masukkan Tahun Lulus...">
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" id="exampleInputEmail1"
                                        value="{{ $DataGuru->jurusan }}" placeholder="Masukkan Jurusan...">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">level</label>
                                    <select name="level" class="custom-select form-control" id="exampleSelectBorder">
                                        <option value="{{ $DataGuru->level }}" selected>{{ $DataGuru->level }}</option>
                                        <option value="kepala sekolah">Kepala Sekolah</option>
                                        <option value="tata usaha">Tata Usaha</option>
                                        <option value="wali kelas">Wali Kelas</option>
                                        <option value="guru mnapel">Guru Mapel</option>
                                    </select>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="text-center alert alert-info" role="alert">
                                    Jabatan & Tugas
                                </div>
                            </div>

                            <div class="col-md-12 row ">
                                <div class="col-md-6 row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label for="exampleSelectBorder">Jabatan</label>
                                        <select name="jabatan" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                            @if ($DataGuru->jabatan == 'kepala sekolah')
                                                <option value="{{ $DataGuru->jabatan }}" selected>
                                                    {{ $DataGuru->jabatan }}</option>
                                                <option value="guru wali kelas">Guru wali kelas</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                                <option value="admin tata usaha">Admin Tata Usaha</option>
                                            @endif
                                            @if ($DataGuru->jabatan == 'guru wali kelas')
                                                <option value="{{ $DataGuru->jabatan }}" selected>
                                                    {{ $DataGuru->jabatan }}</option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                                <option value="admin tata usaha">Admin Tata Usaha</option>
                                            @endif
                                            @if ($DataGuru->jabatan == 'admin tata usaha')
                                                <option value="{{ $DataGuru->jabatan }}" selected>
                                                    {{ $DataGuru->jabatan }}</option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                                <option value="guru wali kelas">Guru wali kelas</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleSelectBorder">Kelas</label>
                                        <select name="kelas_id" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                            <option value="{{ $DataGuru->kelas_id }}" selected>
                                                {{ $DataGuru->angka_kelas }}</option>
                                            @foreach ($kelas as $class)
                                                @if ($class->angka_kelas < 7 && $class->angka_kelas != $DataGuru->angka_kelas)
                                                    <option value="{{ $class->id }}">{{ $class->angka_kelas }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option value="{{ $class->id }}">Tidak Ada Kelas</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6 row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleSelectBorder">Role</label>
                                        <select name="role" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                            @if ($DataGuru->role == 'kepala sekolah')
                                                <option value="{{ $DataGuru->role }}" selected>{{ $DataGuru->role }}
                                                </option>
                                                <option value="guru wali kelas">Guru wali kelas</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                                <option value="admin tata usaha">Admin Tata Usaha</option>
                                            @endif
                                            @if ($DataGuru->role == 'guru wali kelas')
                                                <option value="{{ $DataGuru->role }}" selected>{{ $DataGuru->role }}
                                                </option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                                <option value="admin tata usaha">Admin Tata Usaha</option>
                                            @endif
                                            @if ($DataGuru->role == 'admin tata usaha')
                                                <option value="{{ $DataGuru->role }}" selected>{{ $DataGuru->role }}
                                                </option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                                <option value="guru wali kelas">Guru wali kelas</option>
                                                {{-- <option value="guru wali kelas" >Guru Tidak Tetap</option> --}}
                                            @endif
                                            {{-- <option value="{{$DataGuru->role}}" selected>{{$DataGuru->role}}</option>
                        <option value="kepala sekolah" >Kepala Sekolah</option>
                        <option value="guru wali kelas" >Guru wali kelas</option>
                        <option value="admin tata usaha" >Admin Tata Usaha</option> --}}
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleSelectBorder">Status</label>
                                        <select name="status" class="custom-select form-control"
                                            id="exampleSelectBorder">
                                            <option readonly selected>Masukkan status akun...</option>
                                            @if ($DataGuru->status == 'aktif')
                                                <option value="aktif" selected>Aktif</option>
                                                <option value="non aktif">Non Aktif</option>
                                            @endif
                                            @if ($DataGuru->status == 'non aktif')
                                                <option value="non aktif" selected>Non Aktif</option>
                                                <option value="aktif">Aktif</option>
                                            @endif
                                        </select>
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
{{-- <div id="previewContainer">
  <img id="previewFoto" src="{{asset('storage/guru/'.$DataGuru->foto)}}" alt="Preview Foto" style="max-width: 300px; max-height: 300px;">
</div> --}}
