<?php

namespace App\Http\Controllers;

use App\Models\Landing_Page;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function index(){

        $DataPrestasi = Prestasi::where('status', 'on')->get();
        $landing_page = Landing_Page::all();
        // $landing_page = Landing_Page::all();

        return view('web_profile.index', compact('DataPrestasi', 'landing_page'));
    }


}
