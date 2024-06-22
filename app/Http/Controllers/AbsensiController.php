<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
// model
use App\Models\Siswa;
use App\Models\Kelas;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function ShowSiswaAbsensi($id)
    {
        $title = "Data Murid Kelas :";    
        $DataSiswa = DB::table('siswas')
        ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')->join('gurus','gurus.kelas_id','=','siswas.kelas_id')
        ->select('siswas.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','gurus.nama_guru')
        ->where('kelas.id', $id)
        ->get();
        return view('dashboard.Absensi.ShowSiswaAbsensi',[
            'title'=>$title,
            'DataSiswa'=>$DataSiswa,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
