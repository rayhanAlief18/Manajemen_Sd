    @extends('layoutDash.main');

    @section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{$title}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
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
            <h3 class="card-title">{{$title}}</h3>
            </div>

            
                
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('absensi.update',$DataAbsensiNow->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card-body row ">
                @if($DataAbsensiNow->catatan)
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Catatan</label>
                        <input type="text" name="catatan" class="form-control" id="exampleInputEmail1" value="{{$DataAbsensiNow->catatan }}">
                    </div>
                @else
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Catatan</label>
                        <input type="text" name="catatan" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Catatan..." value="{{ old('catatan') }}">
                    </div>
                @endif
                    <div class="form-group col-md-6">
                        <label for="exampleInputFile">Foto Surat Dokter / Izin</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="image" type="file" id="inputFoto" accept="image/*">
                            </div>
                        </div>
                        
                        <div id="previewContainer">
                            <img src="{{ asset('storage/absensi/' . $DataAbsensiNow->foto_surat_izin) }}" alt="Foto Surat Izin"
                                 style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="reset" class="btn btn-danger">reset</button>
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