<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .content-wrapper {
            padding: 20px;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background-color: #793D00;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
            /* border: none; */
        }

        .card-header img {
            width: 90px;
            height: 90px;
            margin-right: 10px;
            margin-bottom: 20px
        }

        .card-title {
            font-size: 1.5rem;
            margin: 0;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .btn-info {
            background-color: #793D00;
            border: none;
        }

        .btn-info:hover {
            background-color: #532a00;
        }

        .btn-outline-secondary {
            border-radius: 5px;
        }

        .alert {
            margin-top: 20px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        .breadcrumb-item a {
            color: #17a2b8;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #ac5600;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
                        {{-- <img src="path_to_your_logo.png" alt="Logo"
                            style="width: 100px; height: auto; margin-bottom: 20px;">
                        <h1 class="m-0">{{ $title }}</h1> --}}
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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header text-center">
                        <img src="{{asset('web_assets/img/logo_sekolah.png')}}" alt="Logo">
                        <h3 class="card-title">{{ $title }}</h3>
                        <h5>SD Kemala Bhayangkari 1 Surabaya</h5>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->

                    <form id="siswaForm" action="{{ route('ads_siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-sm-4">
                                <label for="nik">NIK</label>
                                <input type="number" name="NIK" class="form-control" id="nik"
                                    placeholder="Masukkan NIK..." value="{{ old('NIK') }}">
                                @error('NIK')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nik">NO KK (Kartu Keluarga)</label>
                                <input type="number" name="NO_KK" class="form-control" id="nik"
                                    placeholder="Masukkan NO_KK..." value="{{ old('NO_KK') }}">
                                @error('NO_KK')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" id="nama_siswa"
                                    placeholder="Masukkan Nama Siswa..." value="{{ old('nama_siswa') }}">
                                @error('nama_siswa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    placeholder="Masukkan Jenis Kelamin..." value="{{ old('tanggal_lahir') }}">
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="laki" {{ old('jenis_kelamin') == 'laki' ? 'selected' : '' }}>Laki-Laki
                                    </option>
                                    <option value="perempuan" {{ old('jenis_kelamin') == 'lperempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="wali_siswa">Ortu / Wali Siswa</label>
                                <input type="text" name="wali_siswa" class="form-control" id="wali_siswa"
                                    placeholder="Masukkan Wali Siswa..." value="{{ old('wali_siswa') }}">
                                @error('wali_siswa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelectBorder">Agama</label>
                                <select name="agama" class="custom-select form-control" id="exampleSelectBorder">
                                    <option value="" {{ old('agama') == '' ? 'selected' : '' }} disabled hidden>
                                        Masukkan Data Agama...</option>
                                    <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="khongucu" {{ old('agama') == 'khongucu' ? 'selected' : '' }}>Khongucu
                                    </option>
                                </select>
                                @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tempat">Alamat</label>
                                <input type="text" name="tempat" class="form-control" id="tempat"
                                    placeholder="Masukkan Tempat Tinggal..." value="{{ old('tempat') }}">
                                @error('tempat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="anak_ke">Anak Ke</label>
                                <input type="number" name="anak_ke" class="form-control" id="anak_ke"
                                    placeholder="Masukkan Anak Ke..." value="{{ old('anak_ke') }}">
                                @error('anak_ke')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-sm-4">
                                <label for="anak_ke">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Masukkan Email..." value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4 ">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" name="password" class="form-control" id="exampleInputEmail1"
                                       placeholder="Masukkan Password..." value="{{old('password')}}">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="window.history.back();">Kembali</button>
                            <button type="submit" class="btn btn-info" onclick="confirmSubmit()">Submit</button>
                            {{-- <button type="reset" class="btn btn-danger float-right">reset</button> --}}
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
