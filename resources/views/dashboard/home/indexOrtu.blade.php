@extends('dashboard.index')

@section('content')
@if (Auth::guard('waliMurid')->check())
<div class="row col-md-12">
    <div class="col-lg-5 col-6">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/guru/' . Auth::guard('waliMurid')->user()->foto) }}"
                            alt="Generic placeholder image" class="img-fluid"
                            style="width: 180px; border-radius: 10px;">
                    </div>
                    <div class="flex-grow-2 ms-3 ml-4">
                        <h5 class="mb-1">{{ Auth::guard('waliMurid')->user()->wali_siswa }}</h5>
                        <p class="mb-2 pb-1">{{ Auth::guard('waliMurid')->user()->level }}</p>
                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                          <div>
                            <p class="small text-muted mb-1">Nama Anak</p>
                            <p class="mb-0">{{ $DataGuru->nama_siswa }}</p>
                        </div>  
                          <div>
                                <p class="small text-muted mb-1">Kelas</p>
                                <p class="mb-0">{{ $DataGuru->angka_kelas }}</p>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Email</p>
                                <p class="mb-0">{{ Auth::guard('waliMurid')->user()->email }}</p>
                            </div>
                        </div>
                        <div class="d-flex pt-1">
                            <a href="{{ route('jadwal.show', Auth::guard('waliMurid')->user()->kelas_id) }}"
                                class="btn btn-primary">Absen Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection