@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (Auth::guard('waliMurid')->check())
                            <h1 class="m-0">Selamat Datang Kembali {{ Auth::guard('waliMurid')->user()->wali_siswa }}</h1>
                        @endif
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
                <!-- Small boxes (Stat box) -->

                @if (Auth::guard('waliMurid')->check())
                    <div class="w-full col-md-12 row">
                        <div class="col-md-4 col-12 card d-flex flex-row justify-content-start align-items-center d-none d-md-flex" style="border-radius: 5px;">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/siswa/' . Auth::guard('waliMurid')->user()->foto_siswa) }}"
                                     alt="Foto Wali Murid" class="img-fluid" style="width: 180px; border-radius: 10px;">
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">{{ Auth::guard('waliMurid')->user()->nama_wali }}</h5>
                                <p class="mb-2">{{ Auth::guard('waliMurid')->user()->level }}</p>
                                <div class="d-flex flex-wrap justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div class="pe-3 mb-2">
                                        <p class="small text-muted mb-1">Kelas</p>
                                        <p class="mb-0">{{ $DataSiswa->angka_kelas }}</p>
                                    </div>
                                    <div class="pe-3 mb-2">
                                        <p class="small text-muted mb-1">Anak</p>
                                        <p class="mb-0">{{ $DataSiswa->nama_siswa }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">Email</p>
                                    <p class="mb-0">{{ Auth::guard('waliMurid')->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Jadwal</h3>

                                    <p>Data Jadwal Pelajaran <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('jadwal.show', Auth::guard('waliMurid')->user()->kelas_id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>History Absensi</sup></h3>

                                    <p>Data Rekap Absensi Siswa <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ url('ShowAllKelasTiapSiswa/' . Auth::guard('waliMurid')->user()->kelas_id . '/' . Auth::guard('waliMurid')->user()->id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>Nilai</h3>

                                    <p>Data Lihat Nilai <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('NilaiSiswaPribadi', Auth::guard('waliMurid')->user()->id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ./col -->

                <!-- ./col -->
                {{-- </div> --}}
                <!-- /.row -->
                <!-- Main row -->
                <!-- Left col -->


                <!-- right col -->
                <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>
@endsection


{{--
@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (Auth::guard('waliMurid')->check())
                            <h1 class="m-0">Selamat Datang Kembali {{ Auth::guard('waliMurid')->user()->wali_siswa }}</h1>
                        @endif
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
                <!-- Small boxes (Stat box) -->

                @if (Auth::guard('waliMurid')->check())
                    <div class="w-full col-md-12 row">
                        <div class="col-md-4 col-12 card d-flex flex-row justify-content-start align-items-center d-none d-md-flex" style="border-radius: 5px; padding: 10px">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/siswa/' . Auth::guard('waliMurid')->user()->foto_siswa) }}"
                                     alt="Foto Wali Murid" class="img-fluid" style="width: 180px; border-radius: 10px;">
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-1">{{ Auth::guard('waliMurid')->user()->nama_wali }}</h5>
                                <p class="mb-2">{{ Auth::guard('waliMurid')->user()->level }}</p>
                                <div class="d-flex flex-wrap justify-content-around rounded-3 p-2 mb-1 bg-body-tertiary">
                                    <div class="pe-2 mb-1">
                                        <p class="small text-muted mb-1">Kelas</p>
                                        <p class="mb-0">{{ $DataSiswa->angka_kelas }}</p>
                                    </div>
                                    <div class="pe-2 mb-1">
                                        <p class="small text-muted mb-1">Anak</p>
                                        <p class="mb-0">{{ $DataSiswa->nama_siswa }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Jadwal</h3>

                                    <p>Data Jadwal Pelajaran <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('jadwal.show', Auth::guard('waliMurid')->user()->kelas_id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>History Absensi</h3>

                                    <p>Data Rekap Absensi Siswa <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ url('ShowAllKelasTiapSiswa/' . Auth::guard('waliMurid')->user()->kelas_id . '/' . Auth::guard('waliMurid')->user()->id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class=" col-md-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>Nilai</h3>

                                    <p>Data Lihat Nilai <br> {{ Auth::guard('waliMurid')->user()->nama_siswa }}</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('NilaiSiswaPribadi', Auth::guard('waliMurid')->user()->id) }}"
                                   class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ./col -->

                <!-- ./col -->
 </div>

                <!-- /.row -->
                <!-- Main row -->
                <!-- Left col -->


                <!-- right col -->
                <!-- /.row (main row) -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

--}}
