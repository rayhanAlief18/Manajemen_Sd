@extends('layoutDash.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Nav Page -->
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                            <li class="breadcrumb-item"><a>{{$title}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    {{-- @foreach ($errors->all() as $error) --}}
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Kesalahan! </strong> Mohon periksa kembali...
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    {{-- @endforeach --}}
                @endif

                <!-- General Form Input Start-->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form {{$title}}</h3>
                    </div>

                    <!-- Form Start -->
                    <form id="prestasiForm" action="{{route('prestasi.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <!-- Input Start -->
                            <div class="form-group col-sm-6">
                                <label for="gambar_thumbnail">Gambar Thumbnail:</label>
                                <input type="file" id="gambar_thumbnail" name="gambar_thumbnail" onchange="previewImage(event, 'preview_thumbnail')">
                                @error('gambar_thumbnail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img id="preview_thumbnail" src="#" alt="Preview Gambar" style="max-width: 50%; height: auto; display: none;">
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: jpeg, png, jpg, svg | max:2mb</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="gambar_prestasi">Gambar Prestasi/Sertifikat:</label>
                                <input type="file" id="gambar_prestasi" name="gambar_prestasi" onchange="previewImage(event, 'preview_prestasi')">
                                @error('gambar_prestasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img id="preview_prestasi" src="#" alt="Preview Gambar" style="max-width: 50%; height: auto; display: none;">
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: jpeg, png, jpg, svg | max:2mb</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="nama_prestasi">Nama Prestasi:</label>
                                <input type="text" name="nama_prestasi" class="form-control" id="nama_prestasi" value="{{ old('nama_prestasi') }}" >
                                @error('nama_prestasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="anggota">Anggota:</label>
                                <input type="text" name="anggota" class="form-control" id="anggota" placeholder="Budi, Andi, Tono" value="{{ old('anggota') }}" >
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: gunakan koma untuk pemisah jika anggota banyak</span>
                                @error('anggota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tingkat">Tingkat:</label>
                                <select id="tingkat" name="tingkat" class="form-control" >
                                    <option value="Kabupaten/Kota" {{ old('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                    <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tgl_prestasi">Tanggal Prestasi:</label>
                                <input type="date" name="tgl_prestasi" class="form-control" id="tgl_prestasi" value="{{ old('tgl_prestasi') }}" >
                                @error('tgl_prestasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="dokumentasi">Dokumentasi:</label>
                                <input type="file" id="dokumentasi" name="dokumentasi[]" multiple onchange="previewDokumentasi(event)">
                                <div id="dokumentasiPreview" class="row mt-2" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;"></div>
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: gunakan ctrl tahan untuk memilih banyak file</span>
                                @error('dokumentasi[]')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> <!-- Input End -->

                        <!-- Button Start-->
                        <div class="card-footer">
                            <a href="{{ route('prestasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="button" class="btn btn-info float-right" onclick="confirmSubmit()">Submit</button>
                        </div>
                        <!-- Button End -->
                    </form> <!-- End Form -->
                </div> <!-- General Form Input End -->
            </div> <!-- Container End -->

            <!-- JS Code -->
            <script>
                function previewImage(event, previewElementId) {
                    var fileInput = event.target;
                    var files = fileInput.files;

                    if (files && files[0]) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var output = document.getElementById(previewElementId);
                            output.src = reader.result;
                            output.style.display = 'block';
                        }
                        reader.readAsDataURL(files[0]);
                    } else {
                        var output = document.getElementById(previewElementId);
                        output.src = '';
                        output.style.display = 'none';
                    }
                }

                function previewDokumentasi(event) {
                    var files = event.target.files;
                    var previewContainer = document.getElementById('dokumentasiPreview');
                    previewContainer.innerHTML = ''; // Clear previous previews

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                            alert(file.name + " is not an image");
                            continue;
                        }

                        var reader = new FileReader();
                        reader.onload = (function(file) {
                            return function(e) {
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'col-md-3';
                                img.style.maxWidth = '100%';
                                img.style.height = 'auto';
                                img.style.marginBottom = '10px';
                                previewContainer.appendChild(img);
                            };
                        })(file);

                        reader.readAsDataURL(file);
                    }
                }

                function confirmSubmit() {
                    Swal.fire({
                        title: 'Tambah Data Prestasi',
                        text: 'Apakah data sudah selesai diisi?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Sudah',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('prestasiForm').submit();
                        }
                    });
                }
            </script> <!-- End JS Code -->
        </section> <!-- /.content -->
    </div>
@endsection
