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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                            <li class="breadcrumb-item"><a>Update Prestasi</a></li>
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
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali...
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif

                <!-- General Form Input Start-->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form {{$title}}</h3>
                    </div>

                    <!-- Form Start -->
                    <form id="prestasiForm" action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <!-- Input Start -->
                            <div class="form-group col-sm-6">
                                <label for="gambar_thumbnail">Gambar Thumbnail:</label>
                                <input type="file" id="gambar_thumbnail" name="gambar_thumbnail" onchange="previewImage(event, 'preview_thumbnail')">
                                @if($prestasi->gambar_thumbnail)
                                    <img id="preview_thumbnail" src="{{ asset('storage/gambar_thumbnail/' . $prestasi->gambar_thumbnail) }}" alt="Preview Gambar" style="max-width: 50%; height: auto;">
                                @else
                                    <img id="preview_thumbnail" src="#" alt="Preview Gambar" style="max-width: 50%; height: auto; display: none;">
                                @endif
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: jpeg, png, jpg, svg | max:2mb</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="gambar_prestasi">Gambar Prestasi/Sertifikat:</label>
                                <input type="file" id="gambar_prestasi" name="gambar_prestasi" onchange="previewImage(event, 'preview_prestasi')">
                                @if($prestasi->gambar_prestasi)
                                    <img id="preview_prestasi" src="{{ asset('storage/gambar_prestasi/' . $prestasi->gambar_prestasi) }}" alt="Preview Gambar" style="max-width: 50%; height: auto;">
                                @else
                                    <img id="preview_prestasi" src="#" alt="Preview Gambar" style="max-width: 50%; height: auto; display: none;">
                                @endif
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: jpeg, png, jpg, svg | max:2mb</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="nama_prestasi">Nama Prestasi:</label>
                                <input type="text" name="nama_prestasi" class="form-control" id="nama_prestasi" required value="{{$prestasi->nama_prestasi}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="anggota">Anggota:</label>
                                <input type="text" name="anggota" class="form-control" id="anggota" placeholder="Budi, Andi, Tono" required value="{{$prestasi->anggota}}">
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: gunakan koma untuk pemisah jika anggota banyak</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tingkat">Tingkat:</label>
                                <select id="tingkat" name="tingkat" class="form-control" required>
                                    <option value="Kabupaten/Kota" {{ $prestasi->tingkat == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                    <option value="Provinsi" {{ $prestasi->tingkat == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ $prestasi->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ $prestasi->tingkat == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tgl_prestasi">Tanggal Prestasi:</label>
                                <input type="date" name="tgl_prestasi" class="form-control" id="tgl_prestasi" required value="{{$prestasi->tgl_prestasi}}">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi...">{{ $prestasi->deskripsi }}</textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="dokumentasi">Dokumentasi:</label>
                                <input type="file" id="dokumentasi" name="dokumentasi[]" multiple onchange="previewDokumentasi(event)">
                                <div id="dokumentasiPreview" class="row mt-2" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;">
                                    @foreach(json_decode($prestasi->dokumentasi) as $file)
                                        <img src="{{ asset('storage/dokumentasi/' . $file) }}" alt="Image Dokumentasi" class="dokumentasi-preview-img" style="max-width: 100%; height: auto">
                                    @endforeach
                                </div>
                                <br>
                                <span class="note" style="color: red; font-size: 13px; font-style: italic;">note: gunakan ctrl tahan untuk memilih banyak file</span>
                            </div>
                        </div><!-- Input End -->

                        <!-- Button Start-->
                        <div class="card-footer">
                            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Back</a>
                            <button type="button" class="btn btn-info" onclick="validateForm()">Submit</button>
                        </div>
                        <!-- Button End -->
                    </form> <!-- End Form -->
                </div> <!-- General Form Input End -->
            </div> <!-- Container End -->

            <!-- Confirm Modal -->
            <div class="modal fade" id="confirmModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirmation Edit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah data <strong>PRESTASI</strong> sudah selesai di edit dengan benar?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Simpan</button>
                        </div>
                    </div>
                </div>
            </div> <!-- End Confirm Modal -->

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

                // Preview Dokumentasi
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

                function validateForm() {
                    var form = document.getElementById('prestasiForm');
                    if (form.checkValidity()) {
                        $('#confirmModal').modal('show');
                    } else {
                        form.reportValidity();
                    }
                }

                function submitForm() {
                    document.getElementById('prestasiForm').submit();
                }
            </script> <!-- End JS Code -->
        </section> <!-- /.content -->
    </div>
@endsection
