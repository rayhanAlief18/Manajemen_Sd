<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

    }

    public function dashboard()
    {
        $title = "Dashboard";

        // $user = Auth::guard('guru')->user();
        // if($user){
        //     if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas') {
        //         $DataGuru = DB::table('gurus')
        //             ->join('kelas', 'gurus.kelas_id', '=', 'kelas.id')
        //             ->select('gurus.*', 'kelas.nama_kelas', 'kelas.angka_kelas', 'kelas.id as id_kelas')
        //             ->where('gurus.id', Auth::guard('guru')->user()->id)
        //             ->first();
        //         $JumlahMurid = DB::table('siswas')->where('kelas_id', Auth::guard('guru')->user()->kelas_id)->count();
        //         return view('dashboard.index', compact('title', 'DataGuru', 'JumlahMurid'));
        // }
        // } elseif (Auth::guard('waliMurid')->user()->level == 'wali murid') {
        //     return view('dashboard.index', compact('title'));
        // }

        // Cek apakah pengguna terautentikasi sebagai guru
        if (Auth::guard('guru')->check()) {
            $user = Auth::guard('guru')->user();
            if ($user->level == 'tata usaha' || $user->level == 'wali kelas') {
                $DataGuru = DB::table('gurus')
                    ->join('kelas', 'gurus.kelas_id', '=', 'kelas.id')
                    ->select('gurus.*', 'kelas.nama_kelas', 'kelas.angka_kelas', 'kelas.id as id_kelas')
                    ->where('gurus.id', $user->id)
                    ->first();
                $JumlahMurid = DB::table('siswas')->where('kelas_id', $user->kelas_id)->count();
                return view('dashboard.index', compact('title', 'DataGuru', 'JumlahMurid'));
            }
        }

        // Cek apakah pengguna terautentikasi sebagai wali murid
        if (Auth::guard('waliMurid')->check()) {
            $user = Auth::guard('waliMurid')->user();
            if ($user->level == 'wali murid') {
                $DataSiswa = DB::table('siswas')
                    ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                    ->select('siswas.*', 'kelas.nama_kelas', 'kelas.angka_kelas', 'kelas.id as id_kelas')
                    ->where('siswas.id', $user->id)
                    ->first();
                
                return view('dashboard.indexOrtu', compact('title','DataSiswa'));
            }
        }

    }
}
