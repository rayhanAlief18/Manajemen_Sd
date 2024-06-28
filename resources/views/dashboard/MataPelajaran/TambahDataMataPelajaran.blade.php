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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $error }}</strong> mohon periksa kembali
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    @endif
    
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>

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
        {{-- @foreach ($errors->all() as $error) --}}
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Kesalahan! </strong> mohon periksa kembali
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{-- @endforeach --}}
    @endif
    
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>

                
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('matapelajaran.store') }}" method="POST">
        @csrf
      <div class="card-body">
        {{-- <div class="form-group row">
          <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
          <div class="col-sm-10">
            <input name="nama_kelas" type="text" class="form-control" id="nama_kelas" placeholder="Masukan Nama Kelas...">
          </div>
        </div>
        <div class="form-group col-sm-6">
          <label for="exampleSelectBorder">Wali Kelas</label>
          <select name="wali_kelas" class="custom-select form-control" id="exampleSelectBorder">
              @foreach ($guru as $guru)
                  <option name="wali_kelas" value="{{$guru->id}}" selected>{{$guru->nama_guru}}</option>
              @endforeach
          </select>
        </div> --}} 

          <div class="row justify-content-center">
            <div class="col-md-6">
              <label for="exampleSelectBorder">Nama Mata Pelajaran</label>
                <input type="text" class="form-control" name="nama_pelajaran" placeholder="Masukkan Nama Pelajaran..." value="{{old('nama_pelajaran')}}">
                @error('nama_pelajaran')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="exampleSelectBorder">Kode Mata Pelajaran</label>
                <input type="text" class="form-control" name="kd_pelajaran" placeholder="Masukkan Kode Mata Pelajaran...">
                @error('kd_pelajaran')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
          </div>
       
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          <button type="submit" class="btn btn-danger ">Cancel</button>
          <button type="submit" class="btn btn-info float-right">Save</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  @endsection
    <!-- /.card-header -->
    
  </div>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  @endsection