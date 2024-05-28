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
    <form action="{{ route('jadwal.update',$jadwal->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleSelectBorder">Mata Pelajaran</label>
                    <select class="custom-select form-control" name="id_mapel" id="exampleSelectBorder">
                        <option selected>Pilih mata pelajaran...</option> 
                        <option value="{{$jadwal->id_mapel}}" selected>{{ $jadwal->nama_mata_pelajaran}}</option>
                        @foreach ($mapel as $mapel)
                            @if($mapel->id != $jadwal->id_mapel)
                                <option value="{{$mapel->id}}" >{{ $mapel->nama_mata_pelajaran}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <div class="form-group col-md-6">
            <label for="exampleSelectBorder">Kelas</label>
                <select class="custom-select form-control" id="exampleSelectBorder" name="id_guru">
                    <option name="id_guru" disabled selected>Pilih guru pengampu...</option> 
                    <option name="id_guru" value="{{$jadwal->id_guru}}" selected>{{ $jadwal->nama_guru}}</option>
                        @foreach ($DataGuru as $guru)
                            @if($guru->id != $jadwal->id_guru)
                                <option name="id_guru" value="{{$guru->id}}">{{ $guru->nama_guru}}</option>
                            @endif
                        @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleSelectBorder">Kelas</label>
                <input name="id_kelas" type="number" class="form-control" placeholder="Masukan jumlah sesi..." readonly value="{{$jadwal->id_kelas}}">{{$jadwal->angka_kelas}}</input> 
               
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Hari</label>
              <select name="hari" class="custom-select form-control" id="exampleSelectBorder">
                        <option name="hari" disabled selected>Pilih hari...</option>
                        <option name="hari" value="{{$jadwal->hari}}" selected>{{$jadwal->hari}}</option>
                        <option name="hari" value="senin" >Senin</option>
                        <option name="hari" value="selasa" >Selasa</option>
                        <option name="hari" value="rabu" >Rabu</option>
                        <option name="hari" value="kamis" >Kamis</option>
                        <option name="hari" value="jumat" >Jumat</option>
                        <option name="hari" value="sabtu" >Sabtu</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Jam Mulai</label>
              <input name="jam_mulai" type="time" class="form-control" placeholder="Masukan Jam Mulai..." value="{{$jadwal->jam_mulai}}">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelectBorder">Jam Selesai</label>
              <input name="jam_selesai" type="time" class="form-control" placeholder="Masukan Jam Selesai..." value="{{$jadwal->jam_selesai}}">
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="exampleSelectBorder">Jumlah Sesi (25 menit = 1 sesi)</label>
            <input name="jumlah_sesi" type="number" class="form-control" placeholder="Masukan jumlah sesi..." value="{{$jadwal->jumlah_sesi}}">
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