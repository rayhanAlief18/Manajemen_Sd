<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
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


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
