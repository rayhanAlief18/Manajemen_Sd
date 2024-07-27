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
                    <div class="card-header d-flex">
                        @if (Auth::guard('guru')->user()->level == 'tata usaha')
                            <a href="{{ route('siswa.create') }}" class="btn btn-primary"><i
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
                                                @foreach ($data as $siswa)
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->NISN }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->tanggal_lahir }}</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        <td>
                                            {{ $siswa->kelas->angka_kelas }}
                                        </td>
                                        {{-- <td>{{ siswa->semester }}</td> --}}
                                        <td>{{ $siswa->wali_siswa }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete" data-name="{{$siswa->nama_siswa}}"><i class="fas fa-trash"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#showModal{{ $siswa->id }}">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Show Modal -->
                                    <div class="modal fade m-0" data-keyboard="false" data-backdrop="static"
                                        id="showModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $siswa->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $siswa->id }}">Detail
                                                        Siswa</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body p-0">
                                                        <div class="card-body row p-4">
                                                            <div class="form-group col-sm-4">
                                                                <img id="previewFoto{{ $siswa->id }}"
                                                                    src="{{ asset('storage/siswa/' . $siswa->foto_siswa) }}"
                                                                    alt="Foto Siswa"
                                                                    style="max-width: 170px; max-height: 170px;">
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $siswa->id }}">NIK</label>
                                                                    <p>{{ $siswa->NIK }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $siswa->id }}">NO. KK (Kartu
                                                                        Keluarga)</label>
                                                                    <p>{{ $siswa->NO_KK }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $siswa->id }}">NIS</label>
                                                                    <p>{{ $siswa->NIS }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nisn{{ $siswa->id }}">NISN</label>
                                                                    <p>{{ $siswa->NISN }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="nama_siswa{{ $siswa->id }}">Nama
                                                                    Lengkap</label>
                                                                <p>{{ $siswa->nama_siswa }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="tanggal_lahir{{ $siswa->id }}">Tanggal
                                                                    Lahir</label>
                                                                <p>{{ $siswa->tanggal_lahir }}</p>
                                                            </div>


                                                            <div class="form-group col-sm-4">
                                                                <label for="jenis_kelamin{{ $siswa->id }}">Jenis
                                                                    Kelamin</label>
                                                                <p>{{ $siswa->jenis_kelamin }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="wali_siswa{{ $siswa->id }}">Orang Tua /
                                                                    Wali</label>
                                                                <p>{{ $siswa->wali_siswa }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="jenis_kelamin{{ $siswa->id }}">Agama</label>
                                                                <p>{{ $siswa->agama }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="jenis_kelamin{{ $siswa->id }}">Tempat</label>
                                                                <p>{{ $siswa->tempat }}</p>
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="jenis_kelamin{{ $siswa->id }}">Anak Ke
                                                                </label>
                                                                <p>{{ $siswa->anak_ke }}</p>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="wali_siswa{{ $siswa->id }}">Kelas</label>
                                                                <p>{{ $siswa->kelas->angka_kelas }}</p>
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label
                                                                    for="wali_siswa{{ $siswa->id }}">Semester</label>
                                                                <p>{{ $siswa->semester }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        const inputFoto{{ $siswa->id }} = document.getElementById('foto_siswa{{ $siswa->id }}');
                                        const previewFoto{{ $siswa->id }} = document.getElementById('previewFoto{{ $siswa->id }}');

                                        inputFoto{{ $siswa->id }}.addEventListener('change', function() {
                                            const file = this.files[0];

                                            if (file) {
                                                const reader = new FileReader();

                                                reader.addEventListener('load', function() {
                                                    previewFoto{{ $siswa->id }}.src = reader.result;
                                                });

                                                reader.readAsDataURL(file);
                                            } else {
                                                previewFoto{{ $siswa->id }}.src = ""; // Reset gambar
                                                previewFoto{{ $siswa->id }}.style.display = 'none'; // Sembunyikan gambar
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
                                    <th>Wali Siswa</th>
                                    <th>Action</th>
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
