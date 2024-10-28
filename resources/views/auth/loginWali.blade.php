<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

    <style>
        
        .wrapper {
            /* display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center; */
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(9px);
            color: #fff;
        }

        .bg-sby {
            min-height: 100vh;
            background: url(image/login/bg.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="hold-transition login-page bg-sby">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('lte/dist/img/LOGO-SD-BHAYANGKARI.png') }}" alt="AdminLTE Logo"
                class="w-25 brand-image img-circle elevation-3">
            <h5 class="text-white"><b>SD Kemala Bhayangkari 1 Surabaya</b></h5>
        </div>
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5 class="text-center">Login Gagal</h5>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- /.login-logo -->
        <div class="card" style=" background: transparent;border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(9px);
        color: #fff;">
            <div class="p-3" style="">
                <p class="login-box-msg">Form Login <span class="text-warning">(Wali Murid)</span></p>

                <form action="{{ route('loginWaliExecute') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-info btn-block">Sign In</button>
                    </div>
                </form>

                <!-- /.social-auth-links -->
                <div class="register-link text-center">
                    <p>Login sebagai <a href="{{ url('/loginGuru') }}" class="text-warning">Guru</a></p>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
</body>

</html>
