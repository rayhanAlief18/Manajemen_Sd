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
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                {{-- <a href="{{route('jadwal.create')}}" class="btn btn-primary mb-3"> Tambah Data Jadwal</a> --}}
                {{-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus mr-2"></i>
          Tambah Data Jadwal
      </button> --}}
                <div class="card">
                    <div class="card-header bg-info text-center">
                        Jadwal hari ini
                    </div>
                    <div class="card-body">

                        {{-- @foreach ($jadwal as $jadwal)

              @endforeach --}}
                        {{-- <a href="" class="btn btn-primary btn-sm my-2">Absensi</a> --}}
                        <div class="row">
                            @if ($hariIni !== 'minggu')
                                @foreach ($jadwal as $jadwalNow)
                                    @if ($jadwalNow->hari == $hariIni)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <div class="d-flex justify-content-start ">
                                                        <h5 class="font-weight-bold text-center">
                                                            {{ $jadwalNow->nama_pelajaran }}</h5>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-3 pl-4  pr-4">
                                                    <div class="d-flex flex-column">
                                                        <div class="">
                                                            <p class="h6 font-weight-normal">{{ $jadwalNow->jumlah_sesi }}
                                                                sesi / 30 menit per-sesi</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column gap-2 ">
                                                        <p class="h5 font-weight-bold">{{ $jadwalNow->jam_mulai }} -
                                                            {{ $jadwalNow->jam_selesai }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @if (Auth::guard('guru')->check())
                                    @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                        <a href="{{ route('ShowSiswaAbsensi', $kelasAbs) }}"
                                            class="btn btn-primary d-flex ml-2"><i
                                                class="fas fa-calendar-check mr-2 mt-1 "></i>
                                            <p class="">Absen</p>
                                        </a>
                                    @else
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-success text-center">
                        Semua Jadwal
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Senin</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                    
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $senin)
                                                    @if ($senin->hari == 'senin')
                                                        <tr>
                                                            <td>{{ $senin->nama_pelajaran }}</td>
                                                            <td>{{ $senin->nama_guru }}</td>
                                                            <td>{{ $senin->jam_mulai }}</td>
                                                            <td>{{ $senin->jam_selesai }}</td>
                                                            <td>{{ $senin->jumlah_sesi }}</td>
                                                            <td>{{ $senin->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                        {{-- <a href="{{ route('jadwal.edit', $senin->id_jadwal) }}"
                                                                            class="btn btn-sm btn-warning"><i
                                                                                class="fas fa-edit"></i></a> --}}
                                                                        <form method="POST"
                                                                            action="{{ route('TransitJadwal',$senin->id_jadwal)  }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $senin->id_jadwal }}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                        
                                                                        <form id="seninForm{{$senin->id_jadwal}}" action="{{ route('jadwal.destroy', $senin->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('seninForm{{$senin->id_jadwal}}', '{{ $senin->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Selasa</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                    
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $selasa)
                                                    @if ($selasa->hari == 'selasa')
                                                        <tr>
                                                            <td>{{ $selasa->nama_pelajaran }}</td>
                                                            <td>{{ $selasa->nama_guru }}</td>
                                                            <td>{{ $selasa->jam_mulai }}</td>
                                                            <td>{{ $selasa->jam_selesai }}</td>
                                                            <td>{{ $selasa->jumlah_sesi }}</td>
                                                            <td>{{ $selasa->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                        
                                                                        <form method="POST"
                                                                            action="{{ route('TransitJadwal',$selasa->id_jadwal)  }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $selasa->id_jadwal }}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                       
                                                                        <form id="selasaForm{{$selasa->id_jadwal}}" action="{{ route('jadwal.destroy', $selasa->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('selasaForm{{$selasa->id_jadwal}}', '{{ $selasa->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Rabu</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $rabu)
                                                    @if ($rabu->hari == 'rabu')
                                                        <tr>
                                                            <td>{{ $rabu->nama_pelajaran }}</td>
                                                            <td>{{ $rabu->nama_guru }}</td>
                                                            <td>{{ $rabu->jam_mulai }}</td>
                                                            <td>{{ $rabu->jam_selesai }}</td>
                                                            <td>{{ $rabu->jumlah_sesi }}</td>
                                                            <td>{{ $rabu->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                        
                                                                        <form method="POST"
                                                                            action="{{route('TransitJadwal',$rabu->id_jadwal)  }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $rabu->id_jadwal }}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                        
                                                                        <form id="rabuForm{{$rabu->id_jadwal}}" action="{{ route('jadwal.destroy', $rabu->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('rabuForm{{$rabu->id_jadwal}}', '{{ $rabu->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Kamis</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                    
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $kamis)
                                                    @if ($kamis->hari == 'kamis')
                                                        <tr>
                                                            <td>{{ $kamis->nama_pelajaran }}</td>
                                                            <td>{{ $kamis->nama_guru }}</td>
                                                            <td>{{ $kamis->jam_mulai }}</td>
                                                            <td>{{ $kamis->jam_selesai }}</td>
                                                            <td>{{ $kamis->jumlah_sesi }}</td>
                                                            <td>{{ $kamis->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                        
                                                                        <form method="POST"
                                                                            action="{{ route('TransitJadwal',$kamis->id_jadwal)  }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $kamis->id_jadwal }}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                        
                                                                        <form id="kamisForm{{$kamis->id_jadwal}}" action="{{ route('jadwal.destroy', $kamis->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('kamisForm{{$kamis->id_jadwal}}', '{{ $kamis->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Jumat</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                    
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $jumat)
                                                    @if ($jumat->hari == 'jumat')
                                                        <tr>
                                                            <td>{{ $jumat->nama_pelajaran }}</td>
                                                            <td>{{ $jumat->nama_guru }}</td>
                                                            <td>{{ $jumat->jam_mulai }}</td>
                                                            <td>{{ $jumat->jam_selesai }}</td>
                                                            <td>{{ $jumat->jumlah_sesi }}</td>
                                                            <td>{{ $jumat->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                       
                                                                        <form method="POST"
                                                                            action="{{ route('TransitJadwal',$jumat->id_jadwal)  }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $jumat->id_jadwal}}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                        
                                                                        <form id="jumatForm{{$jumat->id_jadwal}}" action="{{ route('jadwal.destroy', $jumat->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('jumatForm{{$jumat->id_jadwal}}', '{{ $jumat->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-pastel-warning">
                                        <div class="d-flex justify-content-start ">
                                            <h5 class="font-weight-bold text-center">Sabtu</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                                        <table class="table table-responsive table-borderless">
                                            <thead class="border bg-pastel-primary rounded-lg">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengampu</th>
                                                    <th scope="col">Jam Mulai</th>
                                                    <th scope="col">Jam Selesai</th>
                                                    <th scope="col">Durasi Sesi</th>
                                                    <th scope="col">Hari</th>
                                                    @if (!Auth::guard('waliMurid')->check())
                                                    
                                                        <th scope="col">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jadwal as $sabtu)
                                                    @if ($sabtu->hari == 'sabtu')
                                                        <tr>
                                                            <td>{{ $sabtu->nama_pelajaran }}</td>
                                                            <td>{{ $sabtu->nama_guru }}</td>
                                                            <td>{{ $sabtu->jam_mulai }}</td>
                                                            <td>{{ $sabtu->jam_selesai }}</td>
                                                            <td>{{ $sabtu->jumlah_sesi }}</td>
                                                            <td>{{ $sabtu->hari }}</td>

                                                            @if (Auth::guard('guru')->check())
                                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas')
                                                                    <td>
                                                                        
                                                                        <form method="POST"
                                                                            action="{{ route('TransitJadwal',$sabtu->id_jadwal) }}">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $sabtu->id_jadwal }}"
                                                                                name="id_jadwal">

                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                class="fas fa-edit"></i></button>
                                                                        </form>
                                                                       
                                                                        <form id="sabtuForm{{$sabtu->id_jadwal}}" action="{{ route('jadwal.destroy', $sabtu->id_jadwal) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('sabtuForm{{$sabtu->id_jadwal}}', '{{ $sabtu->nama_pelajaran }}')"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
        </section>
    </div><!-- /.container-fluid -->

    {{-- mmodal Tambah --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" data-keyboard="false" data-backdrop="static"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('jadwal.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mataPelajaran">Mata Pelajaran</label>
                                    <select class="custom-select form-control" name="id_mapel" id="mataPelajaran"
                                        name="matapelajaran">
                                        <option disabled readonly>Pilih mata pelajaran...</option>
                                        @foreach ($mapel as $mapel)
                                            <option name="id_mapel" value="{{ $mapel->id }}">
                                                {{ $mapel->nama_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namaGuru">Guru Pengampu</label>
                                    <select class="custom-select form-control" name="id_guru" id="namaGuru"
                                        name="nama_guru">
                                        <option disabled readonly>Pilih guru pengampu...</option>
                                        @foreach ($DataGuru as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kelas">Kelas</label>
                                    <select class="custom-select form-control" name="id_kelas" id="kelas"
                                        name="kelas">
                                        <option disabled readonly>Pilih kelas...</option>
                                        @foreach ($kelas as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->angka_kelas }}
                                                {{ $kelas->abjad_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hari">Hari</label>
                                    <select class="custom-select form-control" id="hari" name="hari">
                                        <option readonly>Pilih hari...</option>
                                        <option value="senin">Senin</option>
                                        <option value="selasa">Selasa</option>
                                        <option value="rabu">Rabu</option>
                                        <option value="kamis">Kamis</option>
                                        <option value="jumat">Jumat</option>
                                        <option value="sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jamMulai">Jam Mulai</label>
                                    <input name="jam_mulai" type="time" class="form-control" id="jamMulai"
                                        placeholder="Masukan Jam Mulai...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jamSelesai">Jam Selesai</label>
                                    <input name="jam_selesai" type="time" class="form-control" id="jamSelesai"
                                        placeholder="Masukan Jam Selesai...">
                                </div>
                                <div class="form-group col-md-6">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <label for="sesi">Jumlah Sesi</label>
                                <input name="jumlah_sesi" type="number" class="form-control" id="sesi"
                                    placeholder="Masukan jumlah sesi...">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit(formId, dataValue) {
            Swal.fire({
                title: `Hapus Jadwal ${dataValue}`,
                text: 'Anda tidak akan bisa kembalikan data ini lagi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Saya Yakin',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
