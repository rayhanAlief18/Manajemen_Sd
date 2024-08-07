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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('nilai.index')}}">Data Nilai</a></li>
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
                        <div class="text-right mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#filterModal">
                                Lihat Nilai
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog"
                             aria-labelledby="filterModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="GET" action="{{ route('ExPdfAll', ['kelas_id' => $kelas->id]) }}">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select id="semester" name="semester" class="form-control">
                                                    <option value="">Pilih Semester</option>
                                                    @foreach ($smtr as $semester)
                                                        <option value="{{ $semester }}">{{ $semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <select id="tahun_ajaran" name="tahun_ajaran" class="form-control">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    @foreach ($thajar as $tahunAjaran)
                                                        <option value="{{ $tahunAjaran }}">{{ $tahunAjaran }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select id="kategori" name="kategori" class="form-control">
                                                    <option value="">Pilih Kategori</option>
                                                    <option value="uts">UTS / PTS</option>
                                                    <option value="uas">UAS / PAS</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-download me-1"></i> to PDF
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="example1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Semester</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $datas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $datas->NISN }}</td>
                                    <td>{{ $datas->nama_siswa }}</td>
                                    <td>{{ $datas->semester }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('TransitNilaiSiswa',$datas->id) }}">
                                            @csrf
                                            <input type="hidden" value="{{ $datas->id }}" name="id_siswa_nilai">
                                            <button data-toggle="tooltip" data-placement="top"
                                                    title="Masukkan Nilai Siswa"
                                                    class="btn btn-sm btn-primary" type="submit" class="btn btn-info">+
                                                Nilai
                                            </button>
                                        </form>
                                        {{-- <a data-toggle="tooltip" data-placement="top" title="Masukkan Nilai Siswa"
                                            class="btn btn-sm btn-primary"
                                            href="{{ route('nilai.show', $datas->id) . '?id=' . $datas->id . '&nisn=' . $datas->nisn . '&nama_siswa=' . $datas->nama_siswa }}">
                                            + Nilai</a> --}}
                                    </td>
                                </tr>


                                <script>
                                    const inputFoto{{ $datas->id }} = document.getElementById('foto_siswa{{ $datas->id }}');
                                    const previewFoto{{ $datas->id }} = document.getElementById('previewFoto{{ $datas->id }}');

                                    inputFoto{{ $datas->id }}.addEventListener('change', function () {
                                        const file = this.files[0];

                                        if (file) {
                                            const reader = new FileReader();

                                            reader.addEventListener('load', function () {
                                                previewFoto{{ $datas->id }}.src = reader.result;
                                            });

                                            reader.readAsDataURL(file);
                                        } else {
                                            previewFoto{{ $datas->id }}.src = ""; // Reset gambar
                                            previewFoto{{ $datas->id }}.style.display = 'none'; // Sembunyikan gambar
                                        }
                                    });
                                </script>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Semester</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </section>
    </div><!-- /.container-fluid -->

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
