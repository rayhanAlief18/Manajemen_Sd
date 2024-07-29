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
              <li class="breadcrumb-item active">{{$title}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
            @if (session('Success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('Success')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>  
            @endif
        {{-- table --}}
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nisn</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Guru</th>
                  <th>Lihat Absensi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($DataSiswa as $class)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>
                        {{$class->NISN}}
                      </td>
                      <td>
                        {{$class->nama_siswa}}
                      </td>
                      <td>
                        {{$class->angka_kelas}}
                      </td>
                      <td>
                        {{$class->nama_guru}}
                      </td>
                      <td>
                        <form method="POST" action="{{ route('TransitIdSiswaHistoryAbsensi', ['id_kelas' => $class->kelas_id, 'id_siswa' => $class->id]) }}">
                          @csrf
                          <input type="hidden" value="{{ $class->id }}" name="id_siswa">
                          <input type="hidden" value="{{ $class->kelas_id }}" name="id_kelas">
                          <button type="submit" class="btn btn-info"><i class="fas fa-calendar-check"></i></button>
                      </form>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nisn</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Guru</th>
                    <th>Lihat Absensi</th>
                </tr>
                </tfoot>
              </table>
          </div>
          <!-- /.card-body -->
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection