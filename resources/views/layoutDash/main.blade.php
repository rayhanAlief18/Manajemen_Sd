<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SD Kemala Bhayngkari 1 Surabaya</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('lte/dist/css/style.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

    {{-- data table --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('style.css') }}"> --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2C0000;">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                {{-- <img src="dist/img/LOGO-SD-BHAYANGKARI.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"> --}}
                <img src="{{ asset('lte/dist/img/LOGO-SD-BHAYANGKARI.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3">

                <span class="brand-text font-weight-light">SD Kemala 1 Surabaya</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

                @if (Auth::guard('guru')->check())
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-header">Dashboard</li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-address-book "></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <li class="nav-header">Operasional</li>
                            <li class="nav-item">
                                <a href="{{ url('/siswa') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p> Siswa & Wali
                                    </p>
                                </a>
                            </li>
                            @auth('guru')
                                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                    <li class="nav-item">
                                        <a href="{{ url('/BayarSpp') }}" class="nav-link">
                                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                            <p>
                                                Pembayaran SPP
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/prestasi') }}" class="nav-link">
                                            <i class="nav-icon fas fa-address-book"></i>
                                            <p>
                                                Prestasi Siswa
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            @endauth
                            <li class="nav-item">
                                <a href="{{ url('/nilai') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar  "></i>
                                    <p>
                                        Nilai Siswa
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('matapelajaran.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Mata Pelajaran
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('jadwal.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Pengelolaan Jadwal
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('absensi.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        History Absensi
                                    </p>
                                </a>
                            </li>
                            @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                <li class="nav-item">
                                    <a href="{{ url('/kelas') }}" class="nav-link">
                                        <i class="nav-icon fas fa-layer-group"></i>
                                        <p>
                                            Kelas
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @auth('guru')
                                @if (Auth::guard('guru')->user()->level == 'tata usaha')
                                    <li class="nav-header">Karyawan & Alumni</li>
                                    <li class="nav-item">
                                        <a href="{{ url('/guru') }}" class="nav-link">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>
                                                Guru
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-header">Inventaris</li>
                                    <li class="nav-item">
                                        <a href="{{ url('/ruangan') }}" class="nav-link">
                                            <i class="nav-icon fas fa-dolly"></i>
                                            <p>
                                                Data Ruangan
                                                {{-- <span class="badge badge-info right">2</span> --}}
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            @endauth
                            <li class="nav-header">Keluar</li>
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}" class="nav-link">
                                    <i class="nav-icon fas fa-door-open "></i>
                                    <p>
                                        Logout
                                        {{-- <span class="badge badge-info right">2</span> --}}
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </nav>
                @endif

                @if (!Auth::guard('guru')->check())
                    @if (Auth::guard('waliMurid')->user()->level == 'wali murid')
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                                <li class="nav-header">Dashboard</li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link">
                                        <i class="nav-icon fas fa-address-book "></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header">Operasional</li>
                                <li class="nav-item">
                                    <a href="{{ route('jadwal.show', Auth::guard('waliMurid')->user()->kelas_id) }}"
                                        class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>
                                            Pengelolaan Jadwal
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('ShowAllKelasTiapSiswa/' . Auth::guard('waliMurid')->user()->kelas_id . '/' . Auth::guard('waliMurid')->user()->id) }}"
                                        class="nav-link">
                                        <i class="nav-icon fas fa-calendar-check  "></i>
                                        <p>
                                            History Absensi
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('NilaiSiswaPribadi', Auth::guard('waliMurid')->user()->id) }}"
                                        class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>
                                            Nilai Siswa
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-header">Keluar</li>
                                <li class="nav-item">
                                    <a href="{{ url('/logout') }}" class="nav-link">
                                        <i class="nav-icon fas fa-door-open "></i>
                                        <p>
                                            Logout
                                            {{-- <span class="badge badge-info right">2</span> --}}
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    @endif
                @endif

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        
        @yield('content');
        @include('sweetalert::alert')
        @stack('scripts')

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('lte/dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('lte/dist/js/pages/dashboard.js') }}"></script>

    

    {{-- data tables --}}
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}  "></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    
</body>

</html>
