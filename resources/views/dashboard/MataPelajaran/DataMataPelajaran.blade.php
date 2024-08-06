@extends('layoutDash.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
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
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- table --}}
                <div class="card">
                    <div class="card-header">
                        @auth('guru')
                            @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                <a href="{{ route('matapelajaran.create') }}" class="btn btn-primary"><i
                                        class="mr-2 fas fa-user-plus"></i> Tambah Data</a>
                            @endif
                        @endauth
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped tablealert">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata pelajaran</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $mapel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mapel->nama_pelajaran }}</td>
                                        <td>{{ $mapel->kd_pelajaran }}</td>

                                        <td class="text-center">
                                            @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                            <form action="{{ route('matapelajaran.destroy', $mapel->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('matapelajaran.edit', $mapel->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete" data-name="{{ $mapel->nama_pelajaran }}"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata pelajaran</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th class="text-center">Action</th>
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

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $(".tablealert").on("click", ".btn-delete", function(e) {
                    e.preventDefault();

                    var form = $(this).closest("form");
                    var name = $(this).data("name");

                    Swal.fire({
                        title: "Hapus Data " + name + "?",
                        text: "Anda tidak akan bisa kembalikan data ini lagi",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "bg-primary",
                        confirmButtonText: "Ya, Saya Yakin",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
