<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MataPelajaran;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Mata Pelajaran";
        $mapel = MataPelajaran::all();
        return view('dashboard.MataPelajaran.DataMataPelajaran',[
            'title'=>$title,
            'mapel'=>$mapel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Mata Pelajarans";

        return view('dashboard.MataPelajaran.TambahDataMataPelajaran',[
            'title'=>$title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar.',
            'numeric' => 'Isi :attribute dengan angka.',
            'nama_pelajaran.unique' => 'Mata Pelajaran sudah terdaftar...',
            'kd_pelajaran.unique' => 'Kode mata pelajaran sudah terdaftar...'
        ];
        
        $validator = Validator::make($request->all(), [
            'nama_pelajaran' => 'required|unique:mata_pelajarans,nama_pelajaran',
            'kd_pelajaran' => 'required|unique:mata_pelajarans,kd_pelajaran',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        // ELOQUENT
        $mata_pelajaran = new MataPelajaran;
        $mata_pelajaran->nama_pelajaran = $request->nama_pelajaran;
        $mata_pelajaran->kd_pelajaran = $request->kd_pelajaran;
        $mata_pelajaran->save();

        return redirect()->route('matapelajaran.index')->with('Success','Data berhasil ditambahkan');
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
        $title = "Edit Data Mata Pelajaran";
        $mapel = MataPelajaran::find($id);
        return view('dashboard.MataPelajaran.EditDataMataPelajaran',[
            'title'=>$title,
            'mapel'=>$mapel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'nama_pelajaran' => 'required|unique:mata_pelajarans,nama_pelajaran,'.$id,
            'kd_pelajaran' => 'required|unique:mata_pelajarans,kd_pelajaran,'.$id,
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mata_pelajaran = MataPelajaran::findOrFail($id);
        $mata_pelajaran->nama_pelajaran = $request->nama_pelajaran;
        $mata_pelajaran->kd_pelajaran = $request->kd_pelajaran;
        $mata_pelajaran->save();

        return redirect()->route('matapelajaran.index')->with('Success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();
        
        return redirect()->route('matapelajaran.index')->with('Success', 'Data berhasil dihapus.');
    }
}
