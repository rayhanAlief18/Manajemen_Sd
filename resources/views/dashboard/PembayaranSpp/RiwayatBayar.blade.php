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
                {{-- table --}}
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Bayar</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tagihan</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Bukti Pembayaran</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $datas->kd_bayar }}</td>
                                        <td>{{ $datas->siswa->nama_siswa }}</td>
                                        <td>{{ $datas->siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $datas->bulan. " " . $datas->tahun }}</td>
                                        <td>Rp {{ number_format($datas->jumlah_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ $datas->created_at->format('d F Y') }}</td>
                                        <td>
                                            {{-- <div class="form-group">
                                                <img id="previewFoto" src="{{ asset('storage/BuktiBayar/'.$datas->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                                    style="max-width: 100px; max-height: 100px;">
                                            </div> --}}
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#showModal{{ $datas->id }}">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                            
                                        </td>
                                        {{-- <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('BayarSpp.show', $datas->id) . '?id=' . $datas->id . '&nisn=' . $datas->nisn . '&nama_siswa=' . $datas->nama_siswa }}">Tambah Pembayaran</a>
                                        </td> --}}
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
                                    <!-- Edit Modal -->
                                    {{-- <div class="modal fade m-0" id="showModal{{ $datas->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $datas->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $datas->id }}">Detail
                                                        Siswa</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('siswa.update', $datas->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body p-0">
                                                        <div class="card-body row py-0 px-4 pb-3">
                                                            <div class="form-group col-sm-12 text-center mb-0">
                                                                <label for="foto_siswa{{ $datas->id }}">Foto Siswa</label>
                                                            </div>
                                                            <div class="form-group col-sm-12 text-center">
                                                                <img id="previewFoto{{ $datas->id }}"
                                                                    src="{{ asset('storage/siswa/' . $datas->foto_siswa) }}"
                                                                    alt="Foto Siswa"
                                                                    style="max-width: 170px; max-height: 170px;">
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="nisn{{ $datas->id }}">NISN</label>
                                                                <input type="number" name="NISN" class="form-control"
                                                                    id="nisn{{ $datas->id }}"
                                                                    value="{{ $datas->NISN }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="nama_siswa{{ $datas->id }}">Nama
                                                                    Siswa</label>
                                                                <input type="text" name="nama_siswa" class="form-control"
                                                                    id="nama_siswa{{ $datas->id }}"
                                                                    value="{{ $datas->nama_siswa }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="tanggal_lahir{{ $datas->id }}">Tanggal
                                                                    Lahir</label>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control"
                                                                    id="tanggal_lahir{{ $datas->id }}"
                                                                    value="{{ $datas->tanggal_lahir }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="wali_siswa{{ $datas->id }}">Wali
                                                                    Siswa</label>
                                                                <input type="text" name="wali_siswa" class="form-control"
                                                                    id="wali_siswa{{ $datas->id }}"
                                                                    value="{{ $datas->wali_siswa }}" readonly>
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="jenis_kelamin{{ $datas->id }}">Jenis Kelamin</label>
                                                                <input type="text" name="jenis_kelamin" class="form-control"
                                                                    id="jenis_kelamin{{ $datas->id }}"
                                                                    value="{{ $datas->jenis_kelamin }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="wali_siswa{{ $datas->id }}">Kelas</label>
                                                                <input type="text" name="wali_siswa" class="form-control"
                                                                    id="wali_siswa{{ $datas->id }}"
                                                                    value="{{ $datas->kelas->nama_kelas }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        const inputFoto{{ $datas->id }} = document.getElementById('foto_siswa{{ $datas->id }}');
                                        const previewFoto{{ $datas->id }} = document.getElementById('previewFoto{{ $datas->id }}');

                                        inputFoto{{ $datas->id }}.addEventListener('change', function() {
                                            const file = this.files[0];

                                            if (file) {
                                                const reader = new FileReader();

                                                reader.addEventListener('load', function() {
                                                    previewFoto{{ $datas->id }}.src = reader.result;
                                                });

                                                reader.readAsDataURL(file);
                                            } else {
                                                previewFoto{{ $datas->id }}.src = ""; // Reset gambar
                                                previewFoto{{ $datas->id }}.style.display = 'none'; // Sembunyikan gambar
                                            }
                                        });
                                    </script> --}}
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
