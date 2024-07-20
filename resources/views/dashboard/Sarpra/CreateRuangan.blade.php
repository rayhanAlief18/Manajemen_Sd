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
                            <li class="breadcrumb-item"><a href="{{ route('showLantai', $lantai) }}">Ruangan</a></li>
                            <li class="breadcrumb-item active">Tambah Ruangan</li>
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
                            <strong>Kesalahan! </strong> mohon periksa kembali...
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
                    <form id="ruanganForm" action="{{route('ruangan.store')}}" method="POST">
                        @csrf
                        <div class="card-body row">
                            <!-- Input Start -->
                            <div class="form-group col-sm-6">
                                <label for="nama">Nama Ruangan:</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}">
                                @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="lantai">Lantai:</label>
                                <select id="lantai" name="lantai" class="form-control">
                                    <option value="Lantai 1" {{ old('lantai') == 'Lantai 1' ? 'selected' : '' }}>Lantai 1</option>
                                    <option value="Lantai 2" {{ old('lantai') == 'Lantai 2' ? 'selected' : '' }}>Lantai 2</option>
                                    <option value="Lantai 3" {{ old('lantai') == 'Lantai 3' ? 'selected' : '' }}>Lantai 3</option>
                                </select>
                                @error('lantai')
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
                        </div> <!-- Input End -->

                        <!-- Button Start-->
                        <div class="card-footer">
                            <a href="{{ route('showLantai', $lantai) }}" class="btn btn-secondary">Back</a>
                            <button type="button" class="btn btn-info" onclick="confirmSubmit()">Submit</button>
                        </div>
                        <!-- Button End -->
                    </form> <!-- End Form -->
                </div> <!-- General Form Input End -->
            </div> <!-- Container End -->

            <!-- JS Code -->
            <script>
                function confirmSubmit() {
                    Swal.fire({
                        title: 'Tambah Data Ruangan',
                        text: 'Apakah data sudah selesai diisi?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Sudah',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('ruanganForm').submit();
                        }
                    });
                }
            </script> <!-- End JS Code -->
        </section> <!-- /.content -->
    </div>
@endsection
