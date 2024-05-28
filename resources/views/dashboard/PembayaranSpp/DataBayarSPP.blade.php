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
                    <div class="card-header">
                        <a href="{{ route('RiwayatBayar') }}" class="btn btn-primary"><i class="mr-2 fas fa-eye"></i>
                            Semua Rekap Pembayaran</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $datas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $datas->NISN }}</td>
                                        <td>{{ $datas->nama_siswa }}</td>
                                        <td>{{ $datas->jenis_kelamin }}</td>
                                        <td>{{ $datas->kelas->nama_kelas }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Tambah Pembayaran Siswa"  href="{{ route('BayarSpp.show', $datas->id) . '?id=' . $datas->id . '&nisn=' . $datas->nisn . '&nama_siswa=' . $datas->nama_siswa }}">+ Tambah</a>
                                            <a data-toggle="tooltip" data-placement="top" title="Riwayat Pembayaran Siswa" class="btn btn-sm btn-info"
                                            href="{{ route('riwayatBayarById',  $datas->id) }}"><i class="fa fa-history" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
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

    {{-- TOOLTIP TOOLS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap 4.6 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="path/to/adminlte.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection
