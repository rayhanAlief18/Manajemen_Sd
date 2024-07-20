@extends('layoutDash.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data {{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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

                <div>
                    <a href="{{ route('ruangan.create', ['lantai' => request()->segment(3)]) }}" class="btn btn-primary col-2" style="margin-right: 2%; border-bottom-left-radius: 0; border-bottom-right-radius: 0">
                        <i class="mr-2 fas fa-user-plus"></i> Data Ruangan
                    </a>
                    <a href="{{ route('barang.create', ['lantai' => request()->segment(3)]) }}" class="btn btn-primary col-2" style="margin-right: 2%; border-bottom-left-radius: 0; border-bottom-right-radius: 0">
                        <i class="mr-2 fas fa-user-plus"></i> Data Barang
                    </a>
                </div>

                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('ruangan/lantai/Lantai 1') ? 'active' : '' }}" href="{{ route('showLantai', 'Lantai 1') }}" style="color: black">Lantai 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('ruangan/lantai/Lantai 2') ? 'active' : '' }}" href="{{ route('showLantai', 'Lantai 2') }}" style="color: black">Lantai 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('ruangan/lantai/Lantai 3') ? 'active' : '' }}" href="{{ route('showLantai', 'Lantai 3') }}" style="color: black">Lantai 3</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Total Baik</th>
                                <th>Total Rusak</th>
                                <th>Action</th>
                                <th>Barang</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($dataRuangan as $ruangan)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ruangan->nama}}</td>
                                    <td>{{$ruangan->barangs->sum('barang_baik')}}</td>
                                    <td>{{$ruangan->barangs->sum('barang_rusak')}}</td>
                                    <td class="text-center">
                                        <form id="ruanganForm{{$ruangan->id}}" action="{{route('ruangan.destroy',$ruangan->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('ruangan.edit',$ruangan->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('ruanganForm{{$ruangan->id}}', '{{$ruangan->nama}}')"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-sm btn-info show-modal" data-toggle="modal" data-target="#showRuanganModal{{ $ruangan->id }}"><i class="fas fa-eye"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" class="btn" onclick="toggleSubmenu('{{$loop->iteration}}')">
                                            <i class="fa fa-plus-circle" id="icon-{{$loop->iteration}}"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="submenu hidden" style="display: none" id="submenu-{{$loop->iteration}}">
                                    <td colspan="6">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Barang Baik</th>
                                                <th>Barang Rusak</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($ruangan->barangs as $barang)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$barang->nama}}</td>
                                                    <td>{{$barang->barang_baik}}</td>
                                                    <td>{{$barang->barang_rusak}}</td>
                                                    <td>
                                                        <form id="barangForm{{$barang->id}}" action="{{route('barang.destroy', $barang->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmSubmit('barangForm{{$barang->id}}', '{{$barang->nama}}')"><i class="fas fa-trash"></i></button>
                                                            <button type="button" class="btn btn-sm btn-info show-modal" data-toggle="modal" data-target="#showBarangModal{{ $barang->id }}"><i class="fas fa-eye"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Modal Show Data Barang -->
                                                <div class="modal fade m-0" id="showBarangModal{{$barang->id }}" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showBarangModalLabel{{ $barang->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="showBarangModalLabel{{$barang->id }}">Detail Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form Start -->
                                                                <form action="#" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="card-body row">
                                                                        <!-- Input Start -->
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="nama" style="text-align: left; display: block;">Nama Barang:</label>
                                                                            <input type="text" name="nama" class="form-control" id="nama" value="{{ $barang->nama }}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="ruangan" style="text-align: left; display: block;">Ruangan:</label>
                                                                            <input type="text" name="ruangan" class="form-control" id="ruangan" value="{{ $ruangan->nama }}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="barang_baik" style="text-align: left; display: block;">Barang Baik:</label>
                                                                            <input type="number" name="barang_baik" class="form-control" id="barang_baik" value="{{ $barang->barang_baik }}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label for="barang_rusak" style="text-align: left; display: block;">Barang Rusak:</label>
                                                                            <input type="number" name="barang_rusak" class="form-control" id="barang_rusak" value="{{ $barang->barang_rusak }}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="deskripsi" style="text-align: left; display: block;">Deskripsi:</label>
                                                                            <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi..." readonly>{{ $barang->deskripsi }}</textarea>
                                                                        </div>
                                                                    </div> <!-- Input End -->
                                                                </form> <!-- End Form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Modal Show Data Barang -->
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Modal Show Data Ruangan -->
                                <div class="modal fade m-0" id="showRuanganModal{{$ruangan->id }}" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{ $ruangan->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showModalLabel{{$ruangan->id }}">Detail Ruangan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form Start -->
                                                <form action="#" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body row">
                                                        <!-- Input Start -->
                                                        <div class="form-group col-sm-6">
                                                            <label for="nama" style="text-align: left; display: block;">Nama Ruangan:</label>
                                                            <input type="text" name="nama" class="form-control" id="nama" value="{{ $ruangan->nama }}" readonly>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="lantai" style="text-align: left; display: block;">Lantai:</label>
                                                            <select id="lantai" name="lantai" class="form-control" required disabled>
                                                                <option value="Lantai 1" {{ $ruangan->lantai == 'Lantai 1' ? 'selected' : '' }}>Lantai 1</option>
                                                                <option value="Lantai 2" {{ $ruangan->lantai == 'Lantai 2' ? 'selected' : '' }}>Lantai 2</option>
                                                                <option value="Lantai 3" {{ $ruangan->lantai == 'Lantai 3' ? 'selected' : '' }}>Lantai 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="deskripsi" style="text-align: left; display: block;">Deskripsi:</label>
                                                            <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi..." readonly>{{ $ruangan->deskripsi }}</textarea>
                                                        </div>
                                                    </div> <!-- Input End -->
                                                </form> <!-- End Form -->
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End Modal Show Data Ruangan -->
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Total Baik</th>
                                <th>Total Rusak</th>
                                <th>Action</th>
                                <th>Barang</th>
                            </tr>
                            </tfoot>
                        </table> <!-- End Table -->
                    </div>
                </div> <!-- End General Table -->
            </div>
        </section>
    </div>

    <script>
        function toggleSubmenu(menuId) {
            const submenu = document.getElementById('submenu-' + menuId);
            const icon = document.getElementById('icon-' + menuId);
            if (submenu) {
                if (submenu.style.display === 'none') {
                    submenu.style.display = '';
                    icon.classList.remove('fa-plus-circle');
                    icon.classList.add('fa-minus-circle');
                } else {
                    submenu.style.display = 'none';
                    icon.classList.remove('fa-minus-circle');
                    icon.classList.add('fa-plus-circle');
                }
            }
        }

        function confirmSubmit(formId, dataValue) {
            Swal.fire({
                title: `Hapus Data ${dataValue}`,
                text: 'Anda tidak akan bisa kembalikan data ini lagi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Saya Yakin',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
