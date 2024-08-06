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
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

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
                <a href="{{ route('guru.create') }}" class="btn btn-primary"><i class="mr-2 fas fa-user-plus"></i>
                    Tambah
                    Data</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-striped tablealert">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Kelas</th>
                        {{-- <th>Data Siswa</th> --}}
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($DataGuru as $guru)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guru->nama_guru }}</td>
                            <td>{{ $guru->level }}</td>
                            <td>
                                @if ($guru->level == 'wali kelas')
                                    {{ $guru->angka_kelas }}
                                @else
                                    -
                                @endif
                            </td>
                            {{-- <td >
                  @if ($guru->jabatan == 'guru wali kelas')
                    <a href="{{route('siswa')$guru->id_kelas}}" class="btn btn-info"><i class="fas fa-person"></i>Data Murid</a>
                  @else
                    -
                  @endif
                </td> --}}
                            <td class="text-center">
                                <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" data-name="{{ $guru->nama_guru }}"><i
                                            class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#showModal{{ $guru->id }}">
                                        <i class="fas fa-user"></i>
                                    </button>
                                    {{-- <a href="" class="btn btn-info"><i class="fas fa-user"></i></a> --}}
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade m-0" data-keyboard="false" data-backdrop="static"
                             id="showModal{{ $guru->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="showModalLabel{{ $guru->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalLabel{{ $guru->id }}">Detail
                                            Guru / Kepala Sekolah / Tata Usaha</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body p-0">
                                        <div class="card-body row p-4">
                                            <div class="form-group col-sm-3">
                                                <img id="previewFoto{{ $guru->id }}"
                                                     src="{{ asset('storage/guru/' . $guru->foto) }}" alt="Foto Guru"
                                                     style="max-width: 200px; max-height: 200px;">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="nama_siswa{{ $guru->id }}">Nama
                                                        Lengkap</label>
                                                    <p>{{ $guru->nama_guru }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin{{ $guru->id }}">Jenis
                                                        Kelamin</label>
                                                    <p>{{ $guru->jenis_kelamin }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin{{ $guru->id }}">Agama</label>
                                                    <p>{{ $guru->agama }}</p>
                                                </div>

                                            </div>

                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir{{ $guru->id }}">Tanggal
                                                        Lahir</label>
                                                    <p>{{ $guru->tanggal_lahir }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir{{ $guru->id }}">Tempat
                                                        Lahir</label>
                                                    <p>{{ $guru->tempat_lahir }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir{{ $guru->id }}">Nomor
                                                        Telepon</label>
                                                    <p>{{ $guru->nomor_telepon }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir{{ $guru->id }}">Nomor
                                                        Hp</label>
                                                    <p>{{ $guru->nomor_hp }}</p>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="nisn{{ $guru->id }}">NIK</label>
                                                    <p>{{ $guru->nik }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nisn{{ $guru->id }}">NO. KK (Kartu
                                                        Keluarga)</label>
                                                    <p>{{ $guru->no_kk }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nisn{{ $guru->id }}">NO. NPWP (Nomor Pokok
                                                        Wajib Pajak)</label>
                                                    <p>{{ $guru->nomor_npwp }}</p>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3"></div>

                                            <div class="form-group col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="p-4 row col-md-12">
                                                <div class="form-group col-sm-4">
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Jenjang Pendidikan
                                                            Terakhir</label>
                                                        <p>{{ $guru->jenjang }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Tahun
                                                            Lulus</label>
                                                        <p>{{ $guru->tahun_lulus }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Jurusan</label>
                                                        <p>{{ $guru->jurusan }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Gelar
                                                            Depan</label>
                                                        <p>{{ $guru->gelar_belakang }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Gelar
                                                            Belakang</label>
                                                        <p>{{ $guru->gelar_belakang }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn{{ $guru->id }}">Jurusan</label>
                                                        <p>{{ $guru->jurusan }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <div class="form-group ">
                                                        <label for="wali_siswa{{ $guru->id }}">Jabatan</label>
                                                        <p>{{ $guru->jabatan }}</p>
                                                    </div>
                                                    @if ($guru->jabatan == 'guru wali kelas')
                                                        <div class="form-group">
                                                            <label for="wali_siswa{{ $guru->id }}">Kelas
                                                                Yang Diampu</label>
                                                            <p>{{ $guru->angka_kelas }}</p>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="wali_siswa{{ $guru->id }}">Kelas Yang
                                                            Diampu</label>
                                                        @if ($guru->angka_kelas == 7)
                                                            <p>Tidak ada kelas yang diampu</p>
                                                        @endif
                                                        <p>{{ $guru->angka_kelas }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Kelas</th>
                        {{-- <th>Data Siswa</th> --}}
                        <th class="text-center">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function () {
                $(".tablealert").on("click", ".btn-delete", function (e) {
                    e.preventDefault();

                    var form = $(this).closest("form");
                    var name = $(this).data("name");

                    Swal.fire({
                        title: "Hapus Data " + name + "?",
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
