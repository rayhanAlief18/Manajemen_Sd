@extends('layoutDash.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div> --}}
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid mt-4">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h2 class="card-title">{{ $title }}</h2>
                    </div>



                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('nilai.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <h5 class="pl-3">Kompetensi Indeks 1</h5>
                                <div class="card-body row">
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_1">KI 1 - 1 </label>
                                        <input type="text" name="KI1_1" class="form-control" id="KI1_1"
                                            value="{{ $data->KI1_1 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_2">KI 1 - 2 </label>
                                        <input type="text" name="KI1_2" class="form-control" id="KI1_2"
                                            value="{{ $data->KI1_2 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_3">KI 1 - 3 </label>
                                        <input type="text" name="KI1_3" class="form-control" id="KI1_3"
                                            value="{{ $data->KI1_3 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_4">KI 1 - 4 </label>
                                        <input type="text" name="KI1_4" class="form-control" id="KI1_4"
                                            value="{{ $data->KI1_4 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_5">KI 1 - 5 </label>
                                        <input type="text" name="KI1_5" class="form-control" id="KI1_5"
                                            value="{{ $data->KI1_5 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI1_6">KI 1 - 6 </label>
                                        <input type="text" name="KI1_6" class="form-control" id="KI1_6"
                                            value="{{ $data->KI1_6 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5 class="pl-3">Kompetensi Indeks 2</h5>
                                <div class="card-body row">
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_1">KI 2 - 1 </label>
                                        <input type="text" name="KI2_1" class="form-control" id="KI2_1"
                                            value="{{ $data->KI2_1 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_2">KI 2 - 2 </label>
                                        <input type="text" name="KI2_2" class="form-control" id="KI2_2"
                                            value="{{ $data->KI2_2 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_3">KI 2 - 3 </label>
                                        <input type="text" name="KI2_3" class="form-control" id="KI2_3"
                                            value="{{ $data->KI2_3 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_4">KI 2 - 4 </label>
                                        <input type="text" name="KI2_4" class="form-control" id="KI2_4"
                                            value="{{ $data->KI2_4 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_5">KI 2 - 5 </label>
                                        <input type="text" name="KI2_5" class="form-control" id="KI2_5"
                                            value="{{ $data->KI2_5 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI2_6">KI 2 - 6 </label>
                                        <input type="text" name="KI2_6" class="form-control" id="KI2_6"
                                            value="{{ $data->KI2_6 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="form-group col-sm-4">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" class="custom-select form-control" id="kelas">
                                    @foreach ($kelas as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $data->kelas_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- <div class="form-group col-sm-4">
                                <label for="semester">Semester</label>
                                <select name="semester" class="form-control" id="semester">
                                    <option value="Semester 1" {{ $data->semester == 'Semester 1' ? 'selected' : '' }}>
                                        Semester 1
                                    </option>
                                    <option value="Semester 2"
                                        {{ $data->semester == 'Semester 2' ? 'selected' : '' }}>
                                        Semester 2</option>
                                </select>
                            </div> --}}


                        </div>

                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <h5 class="pl-3">Kompetensi Indeks 3</h5>
                                <div class="card-body row">
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_1">KI 3 - 1 </label>
                                        <input type="text" name="KI3_1" class="form-control" id="KI3_1"
                                            value="{{ $data->KI3_1 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_2">KI 3 - 2 </label>
                                        <input type="text" name="KI3_2" class="form-control" id="KI3_2"
                                            value="{{ $data->KI3_2 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_3">KI 3 - 3 </label>
                                        <input type="text" name="KI3_3" class="form-control" id="KI3_3"
                                            value="{{ $data->KI3_3 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_4">KI 3 - 4 </label>
                                        <input type="text" name="KI3_4" class="form-control" id="KI3_4"
                                            value="{{ $data->KI3_4 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_5">KI 3 - 5 </label>
                                        <input type="text" name="KI3_5" class="form-control" id="KI3_5"
                                            value="{{ $data->KI3_5 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI3_6">KI 3 - 6 </label>
                                        <input type="text" name="KI3_6" class="form-control" id="KI3_6"
                                            value="{{ $data->KI3_6 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5 class="pl-3">Kompetensi Indeks 4</h5>
                                <div class="card-body row">
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_1">KI 4 - 1 </label>
                                        <input type="text" name="KI4_1" class="form-control" id="KI4_1"
                                            value="{{ $data->KI4_1 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_2">KI 4 - 2 </label>
                                        <input type="text" name="KI4_2" class="form-control" id="KI4_2"
                                            value="{{ $data->KI4_2 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_3">KI 4 - 3 </label>
                                        <input type="text" name="KI4_3" class="form-control" id="KI4_3"
                                            value="{{ $data->KI4_3 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_4">KI 4 - 4 </label>
                                        <input type="text" name="KI4_4" class="form-control" id="KI4_4"
                                            value="{{ $data->KI4_4 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_5">KI 4 - 5 </label>
                                        <input type="text" name="KI4_5" class="form-control" id="KI4_5"
                                            value="{{ $data->KI4_5 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="KI4_6">KI 4 - 6 </label>
                                        <input type="text" name="KI4_6" class="form-control" id="KI4_6"
                                            value="{{ $data->KI4_6 }}" placeholder="Masukkan Nilai Siswa...">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back();">Kembali</button>
                        </div>
                    </form>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const inputFoto = document.getElementById('inputFoto');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewFoto.src = reader.result;
                });

                reader.readAsDataURL(file);
            } else {
                previewFoto.src = ""; // Reset gambar
                previewFoto.style.display = 'none'; // Sembunyikan gambar
            }
        });
    </script>
@endsection
