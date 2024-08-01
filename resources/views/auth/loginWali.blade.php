@extends('layoutDash.login')
@section('content')
<div class="wrapper">
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('loginWaliExecute')}}" method="POST">
        @csrf
        <div class="w-full mb-3" style="display: flex; justify-content: center;">
            <img src="{{ asset('lte/dist/img/LOGO-SD-BHAYANGKARI.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3 w-25">
        </div>
        <h5 style="text-align: center">
            SD Kemala Bhayangkari 1 Surabaya 
        </h5>
        <p class="text-warning text-center">( Login sebagai Wali Murid )</p>
        
        <div class="mt-5 input-box">
            <input type="email" name="email" placeholder="Email" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input name="password" type="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div>
            <button type="submit" class="btn">Login</button>

        </div>
    </form>
    <div class="register-link">
        <p>Login sebagai <a href="{{url('/loginGuru')}}">Guru</a></p>
    </div>

</div>
@endsection