@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (Auth::guard('guru')->check())
                        <h1 class="m-0">Selamat datang : {{ Auth::guard('guru')->user()->nama_guru }}</h1>
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

                @if (Auth::guard('guru')->check())
                    
                @endif

                <div class="w-full col-md-12 row">
                    <div class="col-md-4 col-12 card  flex-row justify-content-center d-none d-md-flex " style="border-radius: 5px;">
                        <div class="flex-shrink-0" style="margin-left:-7px;">
                            <img src="{{ asset('storage/guru/' . Auth::guard('guru')->user()->foto) }}"
                                alt="Generic placeholder image" class="img-fluid"
                                style="width: 180px; border-radius:5px;">
                        </div>
                        <div class="flex-grow-1 ms-3 ml-4">
                            <h5 class="mt-2">{{ Auth::guard('guru')->user()->nama_guru }}<br> <span style="font-size: 15px;">{{ Auth::guard('guru')->user()->level }}</span></h5>
                            {{-- <p class="mb-2">{{ Auth::guard('guru')->user()->level }}</p> --}}
                            <div class="d-flex justify-content-start rounded-3 bg-body-tertiary">
                                <div>
                                    <p class="small text-muted mb-1">Kelas</p>
                                    @if(Auth::guard('guru')->user()->level == 'wali kelas')
                                    <p class="mb-0">{{ $DataGuru->angka_kelas }}</p>
                                    @else
                                    <p class="mb-0">-</p>
                                    @endif
                                </div>
                                <div class="px-3">
                                    <p class="small text-muted mb-1">Jumlah Murid</p>
                                    @if(Auth::guard('guru')->user()->level == 'wali kelas')
                                    <p class="mb-0">{{ $JumlahMurid }}</p>
                                    @else
                                    <p class="mb-0">-</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">Email</p>
                                    <p class="mb-0">{{ Auth::guard('guru')->user()->email }}</p>
                                </div>
                            </div>
                            @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                <div class="d-flex mt-3">
                                    <a href="{{ route('jadwal.show', Auth::guard('guru')->user()->kelas_id) }}"
                                        class="btn btn-primary">Absen Sekarang</a>
                                </div>
                            @endif
                        </div>
                </div>
                <div class=" col-md-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Siswa</h3>
                            @if(Auth::guard('guru')->user()->level == 'wali kelas')
                            <p>Data Siswa 
                                Kelas: {{$DataGuru->angka_kelas}}
                            </p>
                            @else
                            <p>Data Siswa 
                            </p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('siswa.index') }}"
                            class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class=" col-md-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>History Absensi</sup></h3>
                            @if(Auth::guard('guru')->user()->level == 'wali kelas')
                            <p>Data Rekap Absensi Siswa Kelas {{$DataGuru->angka_kelas}}</p>
                            @else
                            <p>Data History Absensi Siswa
                            </p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('absensi.index') }}"
                            class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class=" col-md-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>Nilai</h3>

                            <p>Data Lihat Nilai <br> {{ Auth::guard('guru')->user()->nama_siswa }}</p>

                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('nilai.index') }}"
                            class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- Left col -->



            <!-- right col -->
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>
@endsection
