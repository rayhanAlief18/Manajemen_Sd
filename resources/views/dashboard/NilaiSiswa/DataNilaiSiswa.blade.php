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
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                    {{-- <th>Tahun Ajaran</th> --}}
                                    {{-- <th>KI 1</th> --}}
                                    {{-- <th>KI 2</th> --}}
                                    {{-- <th>KI 3</th> --}}
                                    {{-- <th>KI 4</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $datas->NISN }}</td>
                                        <td>{{ $datas->nama_siswa }}</td>
                                        <td>{{ $datas->semester }}</td>
                                        {{-- <td>{{ $datas->tahun_ajaran }}</td> --}}
                                        {{-- <td>{{ $datas->KI1_1 }}</td> --}}
                                        {{-- <td>{{ $datas->KI1_1 }}</td> --}}
                                        {{-- <td>{{ $datas->KI1_1 }}</td> --}}
                                        {{-- <td>{{ $datas->KI1_1 }}</td> --}}

                                        {{-- <td>{{ $datas->kelas->nama_kelas }}</td> --}}
                                        <td>
                                            {{-- <a data-toggle="tooltip" data-placement="top" title="Masukkan Nilai Siswa"
                                                class="btn btn-sm btn-info"
                                                href="{{ route('riwayatBayarById', $datas->id) }}">+ Nilai</a> --}}

                                            <a data-toggle="tooltip" data-placement="top" title="Masukkan Nilai Siswa"
                                                class="btn btn-sm btn-primary"
                                                href="{{ route('nilai.show', $datas->id) . '?id=' . $datas->id . '&nisn=' . $datas->nisn . '&nama_siswa=' . $datas->nama_siswa }}">
                                                + Nilai</a>
                                        </td>
                                    </tr>


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
                                    </script>
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
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
