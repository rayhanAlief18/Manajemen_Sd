@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
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
                    <div class="card-header d-flex">
                        @if (Auth::guard('guru')->user()->level == 'tata usaha')
                            <a href="{{ route('kelas.create', ['id' => $kelas]) }}" class="btn btn-primary"><i
                                    class="mr-2 fas fa-user-plus"></i>
                                Tambah Data</a>
                            <button type="button" class="btn btn-info btn-sm ml-auto" data-toggle="modal"
                                data-target="#NaikKelas">
                                Naik Kelas
                            </button>
                        @endif
                    </div>

                    {{-- MODAL --}}
                    <div class="modal fade m-0" data-keyboard="false" data-backdrop="static" id="NaikKelas" tabindex="-1"
                        role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showModalLabel">Yakin Naik Kelas / Ganti Semester semua
                                        siswa?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <form class="d-flex justify-content-between align-content-center" method="POST"
                                        action="{{ route('siswa.update-semester') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="selectAll">Naikkan Semua:</label>
                                            <input type="checkbox" id="selectAll" required>
                                        </div>
                                        <div class="form-group">
                                            {{-- <label for="siswas">Pilih Siswa:</label> --}}
                                            <select multiple name="siswas[]" id="siswas" class="form-control" hidden>
                                                @foreach ($guru as $siswa)
                                                    <option value="{{ $siswa->id }}" hidden></option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary px-4">Naik Kelas</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped tablealert">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    {{-- <th>Semester</th> --}}
                                    <th>Ortu / Wali Siswa</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $guru)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $guru->NISN }}</td>
                                        <td>{{ $guru->nama_siswa }}</td>
                                        <td>{{ $guru->tanggal_lahir }}</td>
                                        <td>{{ $guru->jenis_kelamin }}</td>
                                        <td>
                                            @if ($guru->angka_kelas === 7)
                                                Alumni
                                            @else
                                                {{ $guru->angka_kelas }}
                                            @endif
                                        </td>
                                        {{-- <td>{{ $guru->semester }}</td> --}}
                                        <td>{{ $guru->wali_siswa }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('siswa.destroy', $guru->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                                    <a href="{{ route('kelas.edit', ['id' => $guru->id, 'kelas_id' => $kelas]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger btn-delete btn-sm"
                                                        data-name="{{ $guru->nama_siswa }}"><i
                                                            class="fas fa-trash"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#showModal{{ $guru->id }}">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade m-0" data-keyboard="false" data-backdrop="static"
                                        id="showModal{{ $guru->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $guru->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $guru->id }}">Detail
                                                        Siswa</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('siswa.update', $guru->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body p-0">
                                                        <div class="card-body row p-4">
                                                            <div class="form-group col-sm-4">
                                                                <img id="previewFoto{{ $guru->id }}"
                                                                    src="{{ asset('storage/siswa/' . $guru->foto_siswa) }}"
                                                                    alt="Foto Siswa"
                                                                    style="max-width: 170px; max-height: 170px;">
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $guru->id }}">NIK</label>
                                                                    <p>{{ $guru->NIK }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $guru->id }}">NO. KK (Kartu
                                                                        Keluarga)</label>
                                                                    <p>{{ $guru->NO_KK }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $guru->id }}">NIS</label>
                                                                    <p>{{ $guru->NIS }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $guru->id }}">NISN</label>
                                                                    <p>{{ $guru->NISN }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="nama_siswa{{ $guru->id }}">Nama
                                                                    Lengkap</label>
                                                                <p>{{ $guru->nama_siswa }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="tanggal_lahir{{ $guru->id }}">Tanggal
                                                                    Lahir</label>
                                                                <p>{{ $guru->tanggal_lahir }}</p>
                                                            </div>


                                                            <div class="form-group col-sm-4">
                                                                <label for="jenis_kelamin{{ $guru->id }}">Jenis
                                                                    Kelamin</label>
                                                                <p>{{ $guru->jenis_kelamin }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="wali_siswa{{ $guru->id }}">Orang Tua /
                                                                    Wali</label>
                                                                <p>{{ $guru->wali_siswa }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="jenis_kelamin{{ $guru->id }}">Agama</label>
                                                                <p>{{ $guru->agama }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="jenis_kelamin{{ $guru->id }}">Tempat</label>
                                                                <p>{{ $guru->tempat }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="jenis_kelamin{{ $guru->id }}">Anak Ke
                                                                </label>
                                                                <p>{{ $guru->anak_ke }}</p>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="wali_siswa{{ $guru->id }}">Kelas</label>
                                                                <p>{{ $guru->angka_kelas }}</p>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="wali_siswa{{ $guru->id }}">Semester</label>
                                                                <p>{{ $guru->semester }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        const inputFoto{{ $guru->id }} = document.getElementById('foto_siswa{{ $guru->id }}');
                                        const previewFoto{{ $guru->id }} = document.getElementById('previewFoto{{ $guru->id }}');

                                        inputFoto{{ $guru->id }}.addEventListener('change', function() {
                                            const file = this.files[0];

                                            if (file) {
                                                const reader = new FileReader();

                                                reader.addEventListener('load', function() {
                                                    previewFoto{{ $guru->id }}.src = reader.result;
                                                });

                                                reader.readAsDataURL(file);
                                            } else {
                                                previewFoto{{ $guru->id }}.src = ""; // Reset gambar
                                                previewFoto{{ $guru->id }}.style.display = 'none'; // Sembunyikan gambar
                                            }
                                        });
                                    </script>


                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectAllCheckbox = document.getElementById('selectAll');
                                            var selectElement = document.getElementById('siswas');

                                            selectAllCheckbox.addEventListener('change', function() {
                                                var isSelected = selectAllCheckbox.checked;
                                                for (var i = 0; i < selectElement.options.length; i++) {
                                                    selectElement.options[i].selected = isSelected;
                                                }
                                            });
                                        });
                                    </script>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Ortu / Wali Siswa</th>
                                    <th class="text-center">Action</th>
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
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $(".tablealert").on("click", ".btn-delete", function(e) {
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
