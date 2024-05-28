@extends('layoutDash.main');

  @section('content');
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
        
        {{-- table --}}
        <div class="card">
          <div class="card-header">
            <a href="" class="btn btn-primary"><i class="mr-2 fas fa-user-plus"></i> Tambah Data</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Action</th>
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