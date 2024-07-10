<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
    }

    public function dashboard(){
        $title = "Dashboard";
        $session_nama= session('nama_guru');

        return view('dashboard.index', compact('title','session_nama'));
    }
}
