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
    <form action="{{ route('kelas.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Mata Pelajaran</label>
              <select class="custom-select form-control" id="exampleSelectBorder">
                  <option name="matapelajaran" disabled selected>Pilih mata pelajaran...</option> 
                  @foreach ($mapel as $mapel)
                      <option name="matapelajaran" value="{{$mapel->id}}" >{{ $mapel->nama_mata_pelajaran}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Kelas</label>
              <select class="custom-select form-control" id="exampleSelectBorder">
                  <option name="nama_guru" disabled selected>Pilih guru pengampu...</option> 
                  @foreach ($DataGuru as $guru)
                      <option name="nama_guru" value="{{$guru->id}}" >{{ $guru->nama_guru}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Kelas</label>
              <select class="custom-select form-control" id="exampleSelectBorder">
                  <option name="kelas" disabled selected>Pilih kelas...</option> 
                  @foreach ($kelas as $kelas)
                      <option name="kelas" value="{{$kelas->id}}" >{{$kelas->angka_kelas}} {{$kelas->abjad_kelas}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Hari</label>
              <select name="matapelajaran" class="custom-select form-control" id="exampleSelectBorder">
                  <option name="matapelajaran" disabled selected>Pilih hari...</option> 
                      <option name="matapelajaran" value="senin" >Senin</option>
                      <option name="matapelajaran" value="selasa" >Selasa</option>
                      <option name="matapelajaran" value="rabu" >Rabu</option>
                      <option name="matapelajaran" value="kamis" >Kamis</option>
                      <option name="matapelajaran" value="jumat" >Jumat</option>
                      <option name="matapelajaran" value="sabtu" >Sabtu</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Jam Mulai</label>
              <input name="jam_mulai" type="time" class="form-control" placeholder="Masukan Jam Mulai...">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Jam Selesai</label>
              <input name="jam_selesai" type="time" class="form-control" placeholder="Masukan Jam Selesai...">
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="exampleSelectBorder">Jam Selesai</label>
            <input name="sesi" type="number" class="form-control" placeholder="Masukan jumlah sesi...">
          </div>
        </div>
        </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <button type="submit" class="btn btn-danger float-right">Cancel</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  @endsection