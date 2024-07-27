<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.loginWali');
    }

    public function loginGuru(Request $request)
    {
        return view('auth.loginGuru');
    }

    public function loginGuruExecute(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Pasword Wajib Diisi'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('guru')->attempt($infoLogin)) {
           
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors("Email dan Password Tidak Valid")->withInput();
        }
    }

    public function loginWali(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Pasword Wajib Diisi'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('waliMurid')->attempt($infoLogin)) {

            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors("Email dan Password Tidak Valid")->withInput();
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('error', 'Anda telah logout.');
    }

}
