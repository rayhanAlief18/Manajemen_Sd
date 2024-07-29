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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Murid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($class->angka_kelas <= 6)
                                                Kelas {{ $class->angka_kelas }}
                                            @endif
                                        </td>
                                        @if ($class->angka_kelas <= 6)
                                            <td>
                                                <form method="POST" action="{{ route('TransitIdSiswaHistoryAbsensi', ['id_kelas' => $class->id, 'id_siswa' => $id_siswa]) }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $id_siswa }}" name="id_siswa_tampilAbs">
                                                    <input type="hidden" value="{{ $class->id }}" name="id_kelas_tampilAbs">
                                                    <button type="submit" class="btn btn-info">Tampilkan Absensi</button>
                                                </form>
                                                    {{-- <a href="{{ route('ShowAbsensiPerSiswa', ['id_kelas' => $class->id, 'id_siswa' => $id_siswa]) }}"
                                                        class="btn btn-info">Tampilkan Absen</a> --}}

                                            </td>
                                        @else
                                            <td>
                                                -
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Murid</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
