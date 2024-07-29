@extends('layoutDash.main')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <!-- List Nilai Siswa -->
                <div class="list-nilai-siswa mt-5">
                    <div class="daftar-nilai">
                        <h4 class="text-center bg-info py-2">Daftar Nilai Siswa</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Kategori UAS / UTS</th>
                                    <th>Nilai</th>
                                    <th>Catatan</th>
                                    @if(Auth::guard('guru')->check())
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $datas->mataPelajaran->nama_pelajaran }}</td>
                                        <td>{{ $datas->semester }}</td>
                                        <td>{{ $datas->tahun_ajaran }}</td>
                                        <td>
                                            @if ($datas->kategori == 'uts')
                                                UTS / PTS
                                            @elseif ($datas->kategori == 'uas')
                                                UAS / PAS
                                            @endif
                                        </td>
                                        <td>{{ $datas->nilai }}</td>
                                        <td>{{ $datas->catatan }}</td>
                                    @if(Auth::guard('guru')->check())

                                        <td>
                                            <form action="{{ route('nilai.edit', $datas->id) }}" method="GET"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    data-toggle="tooltip" data-placement="top">Edit</button>
                                            </form>
                                            <form action="{{ route('nilai.destroy', $datas->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?');"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    data-toggle="tooltip" data-placement="top" title="Hapus Nilai Siswa">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
