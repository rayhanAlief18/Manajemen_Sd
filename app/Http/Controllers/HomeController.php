<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
    }

    public function dashboard(){
        $title = "Dashboard";
        return view('dashboard.index', compact('title'));
    }
}
