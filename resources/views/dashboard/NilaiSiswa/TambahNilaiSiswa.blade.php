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
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title text-center">Data Diri Siswa</h3>
                    </div>

                    <!-- form start -->
                    <form action="{{ route('nilai.store') }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" value="{{ $siswa->nama_siswa }}" class="form-control" id="nama_siswa"
                                    readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nama_kelas">Kelas</label>
                                <input type="text" value="{{ $siswa->kelas->nama_kelas }}" class="form-control"
                                    id="nama_kelas" readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="exampleSelectBorder">Mata Pelajaran</label>
                                <select name="pelajaran_id" class="form-control" id="exampleSelectBorder">
                                    <option value="" selected disabled>Pilih Pelajaran</option>
                                    @foreach ($mapel as $class)
                                    <option value="{{ $class->id }}" {{ old('pelajaran_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->nama_pelajaran }}
                                    @endforeach
                                </select>
                                @error('pelajaran_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="nama_siswa">Semester</label>
                                <input type="text" value="{{ $siswa->semester }}" class="form-control" id="nama_siswa"
                                    readonly>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-control" id="tahun_ajaran">
                                    <option value="">Pilih tahun...</option>
                                    @for ($year = 2010; $year <= date('Y'); $year++)
                                    @php
                                    $yearRange = ($year - 1) . ' / ' . $year;
                                @endphp
                                        <option value="{{ $year - 1 }} / {{ $year }}" {{ old('tahun_ajaran') == $yearRange ? 'selected' : '' }}>{{ $year - 1 }} /
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('tahun_ajaran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-sm-6">
                                <label for="jumlah_pembayaran">Nominal</label>
                                <input type="text" name="jumlah_pembayaran" class="form-control" id="jumlah_pembayaran"
                                    placeholder="Masukkan jumlah_pembayaran...">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="bukti_pembayaran">Bukti Bayar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="bukti_pembayaran" type="file" id="bukti_pembayaran" multiple>
                                    </div>
                                </div>
                            </div>

                            <div id="previewContainer">
                                <img id="previewFoto" src="#" alt="Preview Foto"
                                    style="max-width: 300px; max-height: 300px;">
                            </div> --}}

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info  float-right">Submit</button>
                            {{-- <button type="reset" class="btn btn-outline-secondary">Kembali</button> --}}
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back();">Kembali</button>

                        </div>
                    </form>
                </div>

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
                                    <th>KI 1</th>
                                    <th>KI 2</th>
                                    <th>KI 3</th>
                                    <th>KI 4</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $datas->mataPelajaran->  nama_pelajaran }}</td>
                                        <td>{{ $datas->semester }}</td>
                                        <td>{{ $datas->tahun_ajaran }}</td>
                                        <td>
                                            @php
                                                $sum = $datas->KI1_1 + $datas->KI1_2 + $datas->KI1_3 + $datas->KI1_4 + $datas->KI1_5 + $datas->KI1_6;
                                                $count = ($datas->KI1_1 != 0 ? 1 : 0) +
                                                         ($datas->KI1_2 != 0 ? 1 : 0) +
                                                         ($datas->KI1_3 != 0 ? 1 : 0) +
                                                         ($datas->KI1_4 != 0 ? 1 : 0) +
                                                         ($datas->KI1_5 != 0 ? 1 : 0) +
                                                         ($datas->KI1_6 != 0 ? 1 : 0);
                                            @endphp

                                            @if ($count > 0)
                                                {{ number_format($sum / $count, 2) }}
                                            @else
                                                <p>0</p>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $sum = $datas->KI2_1 + $datas->KI2_2 + $datas->KI2_3 + $datas->KI2_4 + $datas->KI2_5 + $datas->KI2_6;
                                                $count = ($datas->KI2_1 != 0 ? 1 : 0) +
                                                         ($datas->KI2_2 != 0 ? 1 : 0) +
                                                         ($datas->KI2_3 != 0 ? 1 : 0) +
                                                         ($datas->KI2_4 != 0 ? 1 : 0) +
                                                         ($datas->KI2_5 != 0 ? 1 : 0) +
                                                         ($datas->KI2_6 != 0 ? 1 : 0);
                                            @endphp

                                            @if ($count > 0)
                                                {{ number_format($sum / $count, 2) }}

                                            @else
                                                <p>0</p>
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $sum = $datas->KI3_1 + $datas->KI3_2 + $datas->KI3_3 + $datas->KI3_4 + $datas->KI3_5 + $datas->KI3_6;
                                                $count = ($datas->KI3_1 != 0 ? 1 : 0) +
                                                         ($datas->KI3_2 != 0 ? 1 : 0) +
                                                         ($datas->KI3_3 != 0 ? 1 : 0) +
                                                         ($datas->KI3_4 != 0 ? 1 : 0) +
                                                         ($datas->KI3_5 != 0 ? 1 : 0) +
                                                         ($datas->KI3_6 != 0 ? 1 : 0);
                                            @endphp

                                            @if ($count > 0)
                                                {{ number_format($sum / $count, 2) }}
                                            @else
                                                <p>0</p>
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $sum = $datas->KI4_1 + $datas->KI4_2 + $datas->KI4_3 + $datas->KI4_4 + $datas->KI4_5 + $datas->KI4_6;
                                                $count = ($datas->KI4_1 != 0 ? 1 : 0) +
                                                         ($datas->KI4_2 != 0 ? 1 : 0) +
                                                         ($datas->KI4_3 != 0 ? 1 : 0) +
                                                         ($datas->KI4_4 != 0 ? 1 : 0) +
                                                         ($datas->KI4_5 != 0 ? 1 : 0) +
                                                         ($datas->KI4_6 != 0 ? 1 : 0);
                                            @endphp

                                            @if ($count > 0)
                                                {{ number_format($sum / $count, 2) }}
                                            @else
                                                <p>0</p>
                                            @endif
                                        </td>


                                        {{-- <td>{{ $datas->kelas->nama_kelas }}</td> --}}
                                        <td>
                                            <form action="{{ route('nilai.edit', $datas->id) }}" method="GET" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Masukkan Nilai Siswa"> + Nilai</button>
                                            </form>

                                            <form action="{{ route('nilai.destroy', $datas->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?');"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus Nilai Siswa">
                                                    Hapus
                                                </button>
                                            </form>

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

    <script>
        const inputFoto = document.getElementById('bukti_pembayaran');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewFoto.src = reader.result;
                    previewFoto.style.display = 'block'; // Menampilkan gambar setelah dipilih
                });

                reader.readAsDataURL(file);
            } else {
                previewFoto.src = ""; // Reset gambar
                previewFoto.style.display = 'none'; // Sembunyikan gambar
            }
        });
    </script>
@endsection
