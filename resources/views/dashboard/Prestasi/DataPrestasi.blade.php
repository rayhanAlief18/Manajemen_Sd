@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data {{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- Nav Page -->
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Header End-->

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

                <!-- General Table Start -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('prestasi.create') }}" class="btn btn-primary"><i
                                class="mr-2 fas fa-user-plus"></i> Tambah Data</a>
                    </div>
                    <!-- Table Start -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped tablealert">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prestasi</th>
                                    <th>Anggota</th>
                                    <th>Tingkat</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($DataPrestasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_prestasi }}</td>
                                        <td>{{ $item->anggota }}</td>
                                        <td>{{ $item->tingkat }}</td>
                                        <td>{{ $item->tgl_prestasi }}</td>
                                        <td class="text-center d-flex " style="gap:5px">
                                            {{-- BUTTON TAMPIL WEB --}}
                                            @if ($item->status == 'on')
                                                <form action="{{ route('ViewWeb', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success ml-3">ON</button>
                                                </form>
                                            @else
                                                <form action="{{ route('ViewWeb', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger ml-3">OFF</button>
                                                </form>
                                            @endif
                                            {{-- END --}}
                                            <form class="" action="{{ route('prestasi.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('prestasi.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete"
                                                    data-name="{{ $item->nama_prestasi }}"><i
                                                        class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-sm btn-info show-modal"
                                                    data-toggle="modal" data-target="#showModal{{ $item->id }}"><i
                                                        class="fas fa-eye"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Show Data -->
                                    <div class="modal fade m-0" id="showModal{{ $item->id }}" data-keyboard="false"
                                        data-backdrop="static" tabindex="-1" role="dialog"
                                        aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{ $item->id }}">Detail
                                                        Prestasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form Start -->
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body row">
                                                            <!-- Input Start -->
                                                            <div class="form-group col-sm-6"
                                                                style="display: flex; flex-direction: column; align-items: center;">
                                                                <label for="gambar_thumbnail">Gambar Thumbnail</label>
                                                                @if ($item->gambar_thumbnail)
                                                                    <img id="preview_thumbnail{{ $item->id }}"
                                                                        src="{{ asset('storage/gambar_thumbnail/' . $item->gambar_thumbnail) }}"
                                                                        alt="Preview Gambar"
                                                                        style="max-width: 50%; height: auto;">
                                                                @else
                                                                    No File Chosen
                                                                @endif
                                                                <br>
                                                            </div>
                                                            <div class="form-group col-sm-6"
                                                                style="display: flex; flex-direction: column; align-items: center;">
                                                                <label for="gambar_prestasi">Gambar
                                                                    Prestasi/Sertifikat</label>
                                                                @if ($item->gambar_prestasi)
                                                                    <img id="preview_prestasi{{ $item->id }}"
                                                                        src="{{ asset('storage/gambar_prestasi/' . $item->gambar_prestasi) }}"
                                                                        alt="Preview Gambar"
                                                                        style="max-width: 50%; height: auto;">
                                                                @else
                                                                    No File Chosen
                                                                @endif
                                                                <br>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="nama_prestasi">Nama Prestasi:</label>
                                                                <input type="text" name="nama_prestasi"
                                                                    class="form-control" id="nama_prestasi" required
                                                                    value="{{ $item->nama_prestasi }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="anggota">Anggota:</label>
                                                                <input type="text" name="anggota" class="form-control"
                                                                    id="anggota" placeholder="Budi, Andi, Tono" required
                                                                    value="{{ $item->anggota }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="tingkat">Tingkat:</label>
                                                                <select id="tingkat" name="tingkat"
                                                                    class="form-control" required disabled>
                                                                    <option value="Kabupaten/Kota"
                                                                        {{ $item->tingkat == 'Kabupaten/Kota' ? 'selected' : '' }}>
                                                                        Kabupaten/Kota</option>
                                                                    <option value="Provinsi"
                                                                        {{ $item->tingkat == 'Provinsi' ? 'selected' : '' }}>
                                                                        Provinsi</option>
                                                                    <option value="Nasional"
                                                                        {{ $item->tingkat == 'Nasional' ? 'selected' : '' }}>
                                                                        Nasional</option>
                                                                    <option value="Internasional"
                                                                        {{ $item->tingkat == 'Internasional' ? 'selected' : '' }}>
                                                                        Internasional</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="tgl_prestasi">Tanggal Prestasi:</label>
                                                                <input type="date" name="tgl_prestasi"
                                                                    class="form-control" id="tgl_prestasi" required
                                                                    value="{{ $item->tgl_prestasi }}" readonly>
                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <label for="deskripsi">Deskripsi:</label>
                                                                <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi..." readonly>{{ $item->deskripsi }}</textarea>
                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <label for="dokumentasi">Dokumentasi:</label>
                                                                <div id="dokumentasiPreview{{ $item->id }}"
                                                                    class="row mt-2"
                                                                    style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;">
                                                                    @foreach (json_decode($item->dokumentasi) as $file)
                                                                        <img src="{{ asset('storage/dokumentasi/' . $file) }}"
                                                                            class="dokumentasi-preview-img"
                                                                            alt="Image Dokumentasi"
                                                                            style="max-width: 100%; height: auto">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div><!-- Input End -->
                                                    </form> <!-- End Form -->
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Modal Show Data -->
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prestasi</th>
                                    <th>Anggota</th>
                                    <th>Tingkat</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table> <!-- End Table -->
                    </div>
                </div>
            </div>
        </section>
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
