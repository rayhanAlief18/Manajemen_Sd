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

                @if (session('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('Msg'))
                    <div class="alert alert-danger">
                        {{ session('Msg') }}
                    </div>
                @endif

                {{-- table --}}
                <div class="card">
                    <div class="card-header">
                        Data Murid Kelas : {{ $hariIni }}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($DataSiswa as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $class->nama_siswa }}
                                        </td>
                                        <td>
                                            {{ $class->angka_kelas }}
                                        </td>

                                        <td class="d-flex flex-row ">
                                            <form action="{{ route('tambahAbsensiSiswa', $class->id_kelas) }}" method="POST"
                                                class="ml-2 ">
                                                @csrf
                                                <div class="d-flex flex-col d-none">
                                                    <div class="d-none">
                                                        <label for="">id_siswa</label>
                                                        <input name="id_siswa" type="text" value="{{ $class->id }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">id_kelas</label>
                                                        <input name="id_kelas" type="text"
                                                            value="{{ $class->id_kelas }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">date</label>
                                                        <input name="date" type="text"
                                                            value="{{ $hariIni }} {{ $tanggalSekarang }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">status</label>
                                                        <input name="status" type="text" value="hadir">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">Guru</label>
                                                        <input name="nama_guru" type="text"
                                                            value="{{ $class->nama_guru }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Masuk</i></button>
                                            </form>

                                            <form action="{{ route('tambahAbsensiSiswa', $class->id_kelas) }}"
                                                method="POST" class="ml-2 ">
                                                @csrf
                                                <div class="d-flex flex-col d-none">
                                                    <div class="d-none">
                                                        <label for="">id_siswa</label>
                                                        <input name="id_siswa" type="text" value="{{ $class->id }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">id_kelas</label>
                                                        <input name="id_kelas" type="text"
                                                            value="{{ $class->id_kelas }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">date</label>
                                                        <input name="date" type="text"
                                                            value="{{ $hariIni }} {{ $tanggalSekarang }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">status</label>
                                                        <input name="status" type="text" value="izin">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">Guru</label>
                                                        <input name="nama_guru" type="text"
                                                            value="{{ $class->nama_guru }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-warning"> Izin</i></button>
                                            </form>

                                            <form action="{{ route('tambahAbsensiSiswa', $class->id_kelas) }}"
                                                method="POST" class="ml-2 ">
                                                @csrf
                                                <div class="d-flex flex-col d-none">
                                                    <div class="d-none">
                                                        <label for="">id_siswa</label>
                                                        <input name="id_siswa" type="text" value="{{ $class->id }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">id_kelas</label>
                                                        <input name="id_kelas" type="text"
                                                            value="{{ $class->id_kelas }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">date</label>
                                                        <input name="date" type="text"
                                                            value="{{ $hariIni }} {{ $tanggalSekarang }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">status</label>
                                                        <input name="status" type="text" value="sakit">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">Guru</label>
                                                        <input name="nama_guru" type="text"
                                                            value="{{ $class->nama_guru }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info">Sakit</i></button>
                                            </form>

                                            <form action="{{ route('tambahAbsensiSiswa', $class->id_kelas) }}"
                                                method="POST" class="ml-2 ">
                                                @csrf
                                                <div class="d-flex flex-col d-none">
                                                    <div class="d-none">
                                                        <label for="">id_siswa</label>
                                                        <input name="id_siswa" type="text"
                                                            value="{{ $class->id }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">id_kelas</label>
                                                        <input name="id_kelas" type="text"
                                                            value="{{ $class->id_kelas }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">date</label>
                                                        <input name="date" type="text"
                                                            value="{{ $hariIni }} {{ $tanggalSekarang }}">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">status</label>
                                                        <input name="status" type="text" value="tidak hadir">
                                                    </div>
                                                    <div class="d-none">
                                                        <label for="">Guru</label>
                                                        <input name="nama_guru" type="text"
                                                            value="{{ $class->nama_guru }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger">Tidak Hadir</i></button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Murid</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>

                        <hr>

                        <div class="card-header">
                            Murid sudah absen hari ini
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Guru</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($DataAbsensiNow as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $class->nama_siswa }}
                                        </td>
                                        <td>
                                            {{ $class->angka_kelas }}
                                        </td>
                                        <td>
                                            {{ $class->date }}
                                        </td>
                                        <td>
                                            @if ($class->status == 'hadir')
                                                <p class="badge badge badge-success">{{ $class->status }}</p>
                                            @elseif($class->status == 'sakit')
                                                <p class="badge badge badge-info">{{ $class->status }}</p>
                                            @elseif($class->status == 'izin')
                                                <p class="badge badge badge-warning">{{ $class->status }}</p>
                                            @elseif($class->status == 'tidak hadir')
                                                <p class="badge badge badge-danger">{{ $class->status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $class->nama_guru }}
                                        </td>

                                        <td class="d-flex flex-row">
                                            <a href="{{ route('absensi.edit', $class->id) }}"
                                                class="btn btn-primary mr-2"><i class="fas fa-plus-circle"></i></a>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#showModal{{ $class->id }}">
                                                <i class="fas fa-user"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade m-0" data-keyboard="false" data-backdrop="static"
                                        id="showModal{{ $class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $class->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $class->id }}">Detail
                                                        Absensi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body p-0">
                                                    <div class="card-body row p-4">
                                                        <div class="form-group col-md-6">
                                                            <label>Foto</label>
                                                            <img id="previewFoto{{ $class->id }}"
                                                                src="{{ asset('storage/absensi/' . $class->foto_surat_izin) }}"
                                                                alt="Foto Siswa"
                                                                style="max-width: 600px; max-height: 400px;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_siswa{{ $class->id }}">Catatan</label>
                                                                <p>{{ $class->catatan }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Guru</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                    </table>
                </div>


                <!-- /.card-body -->
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
