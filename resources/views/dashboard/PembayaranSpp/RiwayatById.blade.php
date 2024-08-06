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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('BayarSpp.index') }}">Pembayaran SPP</a></li>
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
                {{-- table --}}
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4 class="mb-3">Data diri siswa</h4>
                        <div class="row">
                            <div class="col col-md-2">
                                <div>
                                    <img id="previewFoto{{ $siswa->id }}"
                                        src="{{ asset('storage/siswa/' . $siswa->foto_siswa) }}" alt="Foto Siswa"
                                        style="max-width: 130px; max-height: 130px;">
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div>
                                    <p class="mb-0">Nama Lengkap</p>
                                    <p class="font-weight-bold">{{ $siswa->nama_siswa }}</p>
                                </div>
                                <div>
                                    <p class="mb-0">Tanggal Lahir</p>
                                    <p class="font-weight-bold">{{ $siswa->tanggal_lahir }}</p>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div>
                                    <p class="mb-0">Jenis Kelamin</p>
                                    <p class="font-weight-bold">{{ $siswa->jenis_kelamin }}</p>
                                </div>
                                <div>
                                    <p class="mb-0">Kelas</p>
                                    <p class="font-weight-bold">{{ $siswa->kelas->nama_kelas }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Bayar</th>
                                    {{-- <th>Nama</th> --}}
                                    {{-- <th>Kelas</th> --}}
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Nominal</th>
                                    <th>Tgl Bayar</th>
                                    <th>Bukti Pembayaran</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $datas->kd_bayar }}</td>
                                        {{-- <td>{{ $datas->siswa->nama_siswa }}</td> --}}
                                        {{-- <td>{{ $datas->siswa->kelas->nama_kelas }}</td> --}}
                                        <td>{{ $datas->bulan }}</td>
                                        <td>{{ $datas->tahun }}</td>
                                        <td>Rp {{ number_format($datas->jumlah_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ $datas->created_at->format('d F Y') }}</td>

                                        <td>
                                            {{-- <a class="btn btn-sm btn-primary" href="{{ route('BayarSpp.show', $datas->id) . '?id=' . $datas->id . '&nisn=' . $datas->nisn . '&nama_siswa=' . $datas->nama_siswa }}">Tambah Pembayaran</a> --}}
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#showModal{{ $datas->id }}">
                                            <i class="fas fa-user"></i>
                                        </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade m-0" data-keyboard="false" data-backdrop="static"
                                        id="showModal{{ $datas->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $datas->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $datas->id }}">Bukti Bayar</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body p-0">
                                                    <div class="card-body row p-4">
                                                        <div class="form-group col-md-6 ">
                                                            <img id="previewFoto{{ $datas->id }}"
                                                                src="{{ asset('storage/BuktiBayar/' . $datas->bukti_pembayaran) }}"
                                                                alt="Foto Siswa"
                                                                style="max-width: 600px; max-height: 400px;">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <label for="">Nama </label>
                                                                <p>{{$datas->siswa->nama_siswa}}</p>
                                                            </div>
                                                            <div>
                                                                <label for="">Tanggal Bayar </label>
                                                                <p>{{$datas->bulan. " " . $datas->tahun}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
