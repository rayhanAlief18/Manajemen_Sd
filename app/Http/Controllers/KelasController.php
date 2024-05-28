<?php

namespace App\Http\Controllers;
//kelas
use App\Models\Kelas;
use App\Models\Guru;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Kelas";
        $kelas = DB::table('kelas')
                ->select('kelas.*', 'kelas.id as kelas_id')
                ->get();

        return view('dashboard.Operational.Kelas.DataKelas',[
            'title'=>$title,
            'kelas'=>$kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Kelas";
        $guru = DB::table('guru')->select('guru.*', 'guru.id,guru.nama_guru')->get();
        $Kelas = "";
        return view('dashboard.Operational.Kelas.TambahDataKelas',[
            'title'=>$title,
            'DataGuru'=>$guru,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'wali_kelas' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $kelas = New kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->save();

        return redirect()->route('kelas.index')->with('Success','Data berhasil ditambahkan');

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
