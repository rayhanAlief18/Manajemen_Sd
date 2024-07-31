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
                <!-- Display errors -->
                @if ($errors->any())
                    {{-- @foreach ($errors->all() as $error) --}}
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Kesalahan!</strong> mohon periksa kembali
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- @endforeach --}}
                @endif

                @if (Auth::guard('guru')->check())
                    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal"
                            data-target="#filterModal">
                        <i class="bi bi-funnel me-1"></i> Cetak Nilai
                    </button>

                    <!-- Form section -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title text-center">Data Diri Siswa</h3>
                        </div>
                        <form id="nilaiForm" action="{{ route('nilai.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                            <div class="card-body row">
                                <div class="form-group col-sm-4">
                                    <label for="nisn">NISN</label>
                                    <input type="number" value="{{ $siswa->NISN }}" class="form-control" id="nisn"
                                           readonly>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" value="{{ $siswa->nama_siswa }}" class="form-control"
                                           id="nama_siswa" readonly>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="nama_kelas">Kelas</label>
                                    <input type="text" value="{{ $siswa->kelas->nama_kelas }}" class="form-control"
                                           id="nama_kelas" readonly>
                                </div>

                                {{-- <div class="form-group col-sm-4">
                                <label for="exampleSelectBorder">Mata Pelajaran</label>
                                <select name="pelajaran_id" class="form-control" id="exampleSelectBorder">
                                    <option value="" selected disabled>Pilih Pelajaran</option>
                                    @foreach ($mapel as $class)
                                    <option value="{{ $class->id }}" {{ old('pelajaran_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->nama_pelajaran }} </option>
                                    @endforeach
                                </select>
                                @error('pelajaran_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}

                                <div class="form-group col-sm-4">
                                    <label for="nama_siswa">Semester</label>
                                    <input type="text" value="{{ $siswa->semester }}" class="form-control"
                                           id="nama_siswa" readonly>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <select name="tahun_ajaran" class="form-control" id="tahun_ajaran">
                                        <option value="">Pilih tahun...</option>
                                        @for ($year = 2010; $year <= date('Y'); $year++)
                                            @php
                                                $yearRange = $year - 1 . ' / ' . $year;
                                            @endphp
                                            <option value="{{ $year - 1 }} / {{ $year }}"
                                                {{ old('tahun_ajaran') == $yearRange ? 'selected' : '' }}>
                                                {{ $year - 1 }} /
                                                {{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('tahun_ajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="exampleSelectBorder">Mata Pelajaran</label>
                                    <select name="pelajaran_id" class="form-control" id="exampleSelectBorder">
                                        <option value="" selected disabled>Pilih Pelajaran</option>
                                        @foreach ($mapel as $class)
                                            <option name="pelajaran_id" value="{{ $class->id }}">
                                                {{ $class->nama_pelajaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pelajaran_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="kategori">Kategori UAS / UTS</label>
                                    <select name="kategori" class="form-control" id="kategori">
                                        <option value="">Pilih Kategori...</option>
                                        <option value="uts">UTS / PTS</option>
                                        <option value="uas">UAS / PAS</option>
                                    </select>
                                    @error('kategori')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="nilai">Nilai</label>
                                    <input type="number" name="nilai" class="form-control" id="nilai"
                                           placeholder="Masukkan Nilai" min="0">
                                    @error('nilai')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="catatan">Catatan</label>
                                    <input type="text" name="catatan" class="form-control" id="catatan"
                                           placeholder="Masukkan Catatan">
                                    @error('catatan')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                {{-- <input type="text" value="{{$siswa->id}}" name="id_siswas" style="display:none;"> --}}

                                <button type="button" class="btn btn-info float-right" onclick="confirmSubmit()">Submit</button>
                                <button type="button" class="btn btn-outline-secondary"
                                        onclick="window.history.back();">Kembali
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- List Nilai Siswa -->
                <div class="list-nilai-siswa mt-5">
                    <div class="daftar-nilai">
                        <h4 class="text-center bg-info py-2">Daftar Nilai Siswa</h4>
                        <table class="table table-striped tablealert">
                            <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>Mata Pelajaran</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Kategori UAS / UTS</th>
                                <th>Nilai</th>
                                <th>Catatan</th>
                                @if (Auth::guard('guru')->check())
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
                                    @if (Auth::guard('guru')->check())
                                        <td>
                                            <form action="{{ route('nilai.edit', $datas->id) }}" method="GET"
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                        data-toggle="tooltip" data-placement="top">Edit
                                                </button>
                                            </form>
                                            <form action="{{ route('nilai.destroy', $datas->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-delete"
                                                        data-toggle="tooltip" data-placement="top" data-name="{{ $datas->mataPelajaran->nama_pelajaran }}"
                                                        title="Hapus Nilai Siswa">
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

    <!-- Modal for Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Nilai Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('nilai.exportPdf', $siswa->id) }}">
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        function confirmSubmit(P) {
            Swal.fire({
                title: 'Tambah Nilai Mata Pelajaran',
                text: 'Apakah data sudah selesai diisi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('nilaiForm').submit();
                }
            });
        }
    </script>

    @push('scripts')
        <script type="module">
            $(document).ready(function () {
                $(".tablealert").on("click", ".btn-delete", function (e) {
                    e.preventDefault();

                    var form = $(this).closest("form");
                    var name = $(this).data("name");

                    Swal.fire({
                        title: "Hapus Nilai " + name + "?",
                        text: "Anda tidak akan bisa kembalikan data ini lagi",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "bg-primary",
                        confirmButtonText: "Ya, Saya Yakin",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
