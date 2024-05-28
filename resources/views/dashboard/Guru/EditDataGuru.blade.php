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
        <form action="{{route('guru.update',$DataGuru->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body row">
            <div class="form-group col-sm-6">
                <label for="exampleInputEmail1">Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control" id="exampleInputEmail1" value="{{$DataGuru->nama_guru}}" placeholder="Masukkan Nama Guru...">
            </div>
            <div class="form-group col-sm-6">
                <label for="exampleSelectBorder">Kelas</label>
                <select name="kelas" class="custom-select form-control" id="exampleSelectBorder">
                    <option name="kelas" value="{{$DataGuru->id_kelas}}" selected>{{$DataGuru->nama_kelas}}</option>
                    @foreach ($kelas as $kelas)
                    @if ($kelas->id!=$DataGuru->id_kelas){
                        <option name="kelas" value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>

                        }@endif
                    @endforeach
                </select>
              </div>
            <div class="form-group col-sm-12">
              <label for="exampleInputFile">File input</label>
              <div class="input-group">
                <div class="custom-file">
                    <input name="image" type="file" id="inputFoto" accept="image/*">
                </div>
              </div>
            </div>

            <div id="previewContainer">
                <img id="previewFoto" src="{{asset('storage/guru/'.$DataGuru->foto)}}" alt="Preview Foto" style="max-width: 300px; max-height: 300px;">
            </div>
            
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
            <button type="reset" class="btn btn-danger float-right">reset</button>
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