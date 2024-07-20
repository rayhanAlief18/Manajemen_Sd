@extends('layoutDash.main');

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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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

                @if ($errors->any())
                    {{-- @foreach ($errors->all() as $error) --}}
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Kesalahan! </strong> mohon periksa kembali
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- @endforeach --}}
                @endif

                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>


                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('jadwal.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Mata Pelajaran</label>
                                    <select name="id_mapel" class="custom-select form-control" id="exampleSelectBorder">
                                        <option disabled selected>Pilih mata pelajaran...</option>
                                        @foreach ($mapel as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_mapel')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Guru Pengampu</label>
                                    <select name="id_guru" class="custom-select form-control" id="exampleSelectBorder">
                                        <option disabled selected>Pilih guru pengampu...</option>
                                        @foreach ($DataGuru as $guru)
                                            @if ($guru->angka_kelas !== 8 )
                                                @if (Auth::guard('guru')->user()->level == 'tata usaha' || $guru->level == 'guru mapel')
                                                    {
                                                    <option value="{{ $guru->id }}"
                                                        {{ old('id_guru') == $guru->id ? 'selected' : '' }}>
                                                        {{ $guru->nama_guru }} ({{ $guru->nama_kelas }})</option>
                                                @endif
                                            @endif
                                            @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                                {
                                                @if (Auth::guard('guru')->user()->kelas_id == $guru->kelas_id || $guru->level == 'guru mapel')
                                                    <option value="{{ $guru->id }}">
                                                        {{ $guru->nama_guru }} (Kelas : {{ $guru->nama_kelas }})
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_guru')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Kelas</label>
                                    <select name="id_kelas" class="custom-select form-control" id="exampleSelectBorder">
                                        <option disabled selected>Pilih kelas...</option>
                                        @foreach ($kelas as $kelas)
                                            @if ($kelas->angka_kelas <= 6)
                                                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                                    {
                                                    <option value="{{ $kelas->id }}"
                                                        {{ old('id_kelas') == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->angka_kelas }}
                                                    </option>
                                                @endif
                                                @if (Auth::guard('guru')->user()->level == 'wali kelas')
                                                    {
                                                    @if (Auth::guard('guru')->user()->kelas_id == $kelas->id)
                                                        {
                                                        <option value="{{ $kelas->id }}"
                                                            {{ old('id_kelas') == $kelas->id ? 'selected' : '' }} selected >
                                                            {{ $kelas->nama_kelas }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Hari</label>
                                    <select name="hari" class="custom-select form-control" id="exampleSelectBorder">
                                        <option disabled selected>Pilih hari...</option>
                                        <option value="senin" {{ old('hari') == 'senin' ? 'selected' : '' }}>Senin
                                        </option>
                                        <option value="selasa" {{ old('hari') == 'selasa' ? 'selected' : '' }}>Selasa
                                        </option>
                                        <option value="rabu" {{ old('hari') == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="kamis" {{ old('hari') == 'kamis' ? 'selected' : '' }}>Kamis
                                        </option>
                                        <option value="jumat" {{ old('hari') == 'jumat' ? 'selected' : '' }}>Jumat
                                        </option>
                                        <option value="sabtu" {{ old('hari') == 'sabtu' ? 'selected' : '' }}>Sabtu
                                        </option>
                                    </select>
                                    @error('hari')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Jam Mulai</label>
                                    <input name="jam_mulai" type="time" class="form-control"
                                        placeholder="Masukan Jam Mulai..." value="{{ old('jam_mulai') }}">
                                    @error('jam_mulai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectBorder">Jam Selesai</label>
                                    <input name="jam_selesai" type="time" class="form-control"
                                        placeholder="Masukan Jam Selesai..." value="{{ old('jam_selesai') }}">
                                    @error('jam_selesai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleSelectBorder">Jumlah sesi</label>
                                <input name="jumlah_sesi" type="number" class="form-control"
                                    placeholder="Masukan jumlah sesi..." value="{{ old('jumlah_sesi') }}">
                                @error('jumlah_sesi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
