@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Selamat datang : </h1>
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
                    <div class="row col-md-12">
                        <div class="col-lg-5 col-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/guru/' . Auth::guard('guru')->user()->foto) }}"
                                                alt="Generic placeholder image" class="img-fluid"
                                                style="width: 180px; border-radius: 10px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3 ml-4">
                                            <h5 class="mb-1">{{ Auth::guard('guru')->user()->nama_guru }}</h5>
                                            <p class="mb-2 pb-1">{{ Auth::guard('guru')->user()->level }}</p>
                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                                <div>
                                                    <p class="small text-muted mb-1">Kelas</p>
                                                    <p class="mb-0">{{ $DataGuru->angka_kelas }}</p>
                                                </div>
                                                <div class="px-3">
                                                    <p class="small text-muted mb-1">Jumlah Murid</p>
                                                    <p class="mb-0">{{ $JumlahMurid }}</p>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-1">Email</p>
                                                    <p class="mb-0">{{ Auth::guard('guru')->user()->email }}</p>
                                                </div>
                                            </div>
                                            @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                                <div class="d-flex pt-1">
                                                    <a href="{{ route('jadwal.show', Auth::guard('guru')->user()->kelas_id) }}"
                                                        class="btn btn-primary">Absen Sekarang</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif

                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
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
