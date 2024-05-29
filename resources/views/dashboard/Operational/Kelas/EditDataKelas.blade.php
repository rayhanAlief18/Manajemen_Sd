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

                
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('kelas.update',$kelas->id) }}" method="POST" class="form-horizontal">
        @method('PUT')
        @csrf
      <div class="card-body">
          <div class="row ">
            <div class="col-md-6">
              <label for="exampleSelectBorder">Angka Kelas</label>
              <select name="angka_kelas" class="custom-select form-control" id="exampleSelectBorder">
                      <option  value="{{$kelas->angka_kelas}}" selected>{{$kelas->angka_kelas}}</option>
                      <option  value="1" > 1 </option>
                      <option  value="2" > 2 </option>
                      <option  value="3" > 3 </option>
                      <option  value="4" > 4 </option>
                      <option  value="5" > 5 </option>
                      <option  value="6" > 6 </option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Wali Kelas</label>
              <select name="wali_kelas" class="custom-select form-control" id="exampleSelectBorder">
                <option  value="{{$kelas->nama_guru}}" >{{$kelas->nama_guru}}</option>
                @foreach ($guru as $guru)
                    @if($guru->kelas_id != $kelas->id)
                        <option name="wali_kelas" value="{{$guru->id}}">{{$guru->nama_guru}}</option>
                    @endif
                  @endforeach
              </select>
            </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <button type="reset" class="btn btn-danger float-right">Cancel</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  @endsection