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
        {{-- <a href="{{route('jadwal.create')}}" class="btn btn-primary mb-3"> Tambah Data Jadwal</a> --}}
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus mr-2"></i>
          Tambah Data Jadwal
      </button>
        <div class="card">
          <div class="card-header bg-success text-center" >
            Jadwal hari ini
          </div>
          <div class="card-body">
            <div class="row">
                @foreach($jadwal as $jadwalNow)
                @if($jadwalNow->hari == $hariIni )
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header bg-success">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">{{$jadwalNow ->nama_mata_pelajaran}}</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4  pr-4">
                      <div class="d-flex flex-column">
                        <div class="">
                          <p class="h6 font-weight-normal">{{$jadwalNow ->jumlah_sesi}} sesi / 30 menit per-sesi</p>
                        </div>
                      </div>
                      <div class="d-flex flex-column gap-2 ">
                        <p class="h5 font-weight-bold">{{$jadwalNow ->jam_mulai}} - {{$jadwalNow ->jam_selesai}}</p>
                      </div>
                    </div>
                    <a href="" class="btn btn-primary mb-2 ml-2 w-25">Absen</a>
                  </div>
                </div>
                
                @endif
                @endforeach
              </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-success text-center" >
            Semua Jadwal
          </div>
          <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Senin</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $senin)
                          @if($senin->hari == "senin")

                            <tr>
                                <td>{{ $senin->angka_kelas}} </td>
                                <td>{{ $senin->nama_mata_pelajaran }}</td>
                                <td>{{ $senin->nama_guru}}</td>
                                <td>{{ $senin->jam_mulai}}</td>
                                <td>{{ $senin->jam_selesai}}</td>
                                <td>{{ $senin->jumlah_sesi}}</td>
                                <td>{{ $senin->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$senin->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$senin->id_jadwal)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Selasa</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $selasa)
                          @if($selasa->hari == "selasa")
                            <tr>
                              <td>{{ $selasa->angka_kelas}} </td>
                              <td>{{ $selasa->nama_mata_pelajaran }}</td>
                              <td>{{ $selasa->nama_guru}}</td>
                                <td>{{ $selasa->jam_mulai}}</td>
                                <td>{{ $selasa->jam_selesai}}</td>
                                <td>{{ $selasa->jumlah_sesi}}</td>
                                <td>{{ $selasa->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$selasa->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$selasa->id_jadwal)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Rabu</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $rabu)
                          @if($rabu->hari == "rabu")
                            <tr>
                              <td>{{ $rabu->angka_kelas}}</td>
                              <td>{{ $rabu->nama_mata_pelajaran }}</td>
                              <td>{{ $rabu->nama_guru}}</td>
                                <td>{{ $rabu->jam_mulai}}</td>
                                <td>{{ $rabu->jam_selesai}}</td>
                                <td>{{ $rabu->jumlah_sesi}}</td>
                                <td>{{ $rabu->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$rabu->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$rabu->id_jadwal)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Kamis</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $kamis)
                          @if($kamis->hari == "kamis")
                            <tr>
                              <td>{{ $kamis->angka_kelas}}</td>
                              <td>{{ $kamis->nama_mata_pelajaran }}</td>
                              <td>{{ $kamis->nama_guru}}</td>
                                <td>{{ $kamis->jam_mulai}}</td>
                                <td>{{ $kamis->jam_selesai}}</td>
                                <td>{{ $kamis->jumlah_sesi}}</td>
                                <td>{{ $kamis->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$kamis->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$kamis->id_jadwal)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Jumat</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $jumat)
                          @if($jumat->hari == "jumat")
                            <tr>
                              <td>{{ $jumat->angka_kelas}}</td>
                              <td>{{ $jumat->nama_mata_pelajaran }}</td>
                              <td>{{ $jumat->nama_guru}}</td>
                                <td>{{ $jumat->jam_mulai}}</td>
                                <td>{{ $jumat->jam_selesai}}</td>
                                <td>{{ $jumat->jumlah_sesi}}</td>
                                <td>{{ $jumat->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$jumat->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$jumat->id_jadwal)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-pastel-warning">
                      <div class="d-flex justify-content-start ">
                        <h5 class="font-weight-bold text-center">Sabtu</h5>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-4 pb-2 pr-4">
                      <table class="table table-responsive table-borderless">
                        <thead class="border bg-pastel-primary rounded-lg">
                          <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Durasi Sesi</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal as $sabtu)
                          @if($sabtu->hari == "sabtu")
                            <tr>
                              <td>{{ $sabtu->angka_kelas}}</td>
                              <td>{{ $sabtu->nama_mata_pelajaran }}</td>
                              <td>{{ $sabtu->nama_guru}}</td>
                                <td>{{ $sabtu->jam_mulai}}</td>
                                <td>{{ $sabtu->jam_selesai}}</td>
                                <td>{{ $sabtu->jumlah_sesi}}</td>
                                <td>{{ $sabtu->hari}}</td>
                                
                                <td>
                                  <form action="{{route('jadwal.destroy',$sabtu->id_jadwal)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('jadwal.edit',$sabtu->id_jadwal)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endif
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
          </div>
        </div>

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    {{-- mmodal Tambah --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                   
                </div>
                <form action="{{ route('jadwal.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mataPelajaran">Mata Pelajaran</label>
                                    <select class="custom-select form-control" name="id_mapel" id="mataPelajaran" name="matapelajaran">
                                        <option disabled readonly>Pilih mata pelajaran...</option> 
                                        @foreach ($mapel as $mapel)
                                            <option name="id_mapel" value="{{$mapel->id}}">{{ $mapel->nama_mata_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namaGuru">Guru Pengampu</label>
                                    <select class="custom-select form-control" name="id_guru" id="namaGuru" name="nama_guru">
                                        <option disabled readonly>Pilih guru pengampu...</option> 
                                        @foreach ($DataGuru as $guru)
                                            <option value="{{$guru->id}}">{{ $guru->nama_guru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kelas">Kelas</label>
                                    <select class="custom-select form-control" name="id_kelas" id="kelas" name="kelas">
                                        <option disabled readonly>Pilih kelas...</option> 
                                        @foreach ($kelas as $kelas)
                                            <option value="{{$kelas->id}}">{{$kelas->angka_kelas}} {{$kelas->abjad_kelas}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hari">Hari</label>
                                    <select class="custom-select form-control" id="hari" name="hari">
                                        <option readonly>Pilih hari...</option> 
                                        <option value="senin">Senin</option>
                                        <option value="selasa">Selasa</option>
                                        <option value="rabu">Rabu</option>
                                        <option value="kamis">Kamis</option>
                                        <option value="jumat">Jumat</option>
                                        <option value="sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jamMulai">Jam Mulai</label>
                                    <input name="jam_mulai" type="time" class="form-control" id="jamMulai" placeholder="Masukan Jam Mulai...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jamSelesai">Jam Selesai</label>
                                    <input name="jam_selesai" type="time" class="form-control" id="jamSelesai" placeholder="Masukan Jam Selesai...">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sesi">Jumlah Sesi</label>
                                    <input name="jumlah_sesi" type="number" class="form-control" id="sesi" placeholder="Masukan jumlah sesi...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  {{-- end tambah modal --}}



</div>
</section>
<!-- /.content -->
</div>
@endsection