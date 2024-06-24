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
          <div class="card-header">
            <a href="{{ route('kelas.create') }}" class="btn btn-primary"><i class="mr-2 fas fa-user-plus"></i> Tambah Data</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Murid</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($kelas as $class)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                    @if($class->angka_kelas <= 6)
                      {{ $class->angka_kelas}}
                    @elseif($class->angka_kelas == 7)
                      Lulus
                    @elseif($class->angka_kelas == 8)
                      Tanpa Kelas 
                    @endif
                    </td>
                    @if($class->angka_kelas <= 6)
                    <td>
                      <a href="" class="btn btn-info"><i class="fas fa-person"></i>Murid</a>
                    </td>
                    @else
                    <td>
                      -
                    </td>
                    @endif
                    
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Murid</th>
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
