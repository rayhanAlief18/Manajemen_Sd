<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\MataPelajaran;
use RealRashid\SweetAlert\Facades\Alert;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas') {
            $title = "Mata Pelajaran";
            $mapel = MataPelajaran::all();

            confirmDelete();

            return view('dashboard.MataPelajaran.DataMataPelajaran', [
                'title' => $title,
                'mapel' => $mapel,
            ]);
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $title = "Tambah Mata Pelajaran";

            return view('dashboard.MataPelajaran.TambahDataMataPelajaran', [
                'title' => $title,
            ]);
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {

            $messages = [
                'required' => ':Attribute harus diisi.',
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

            // Sweet alert
            Alert::success('Berhasil Ditambahkan', 'Mata pelajaran berhasil ditambahkan.');

            // ELOQUENT
            $mata_pelajaran = new MataPelajaran;
            $mata_pelajaran->nama_pelajaran = $request->nama_pelajaran;
            $mata_pelajaran->kd_pelajaran = $request->kd_pelajaran;
            $mata_pelajaran->save();
            return redirect()->route('matapelajaran.index');

        } else {
            return back();
        }
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
        if (Auth::guard('guru')->user()->level == 'tata usaha') {

            $title = "Edit Data Mata Pelajaran";
            $mapel = MataPelajaran::find($id);
            return view('dashboard.MataPelajaran.EditDataMataPelajaran', [
                'title' => $title,
                'mapel' => $mapel,
            ]);
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {

            $messages = [
                'required' => ':Attribute harus diisi.',
                'email' => 'Isi :attribute dengan format yang benar',
                'numeric' => 'Isi attribute dengan angka'
            ];

            $validator = Validator::make($request->all(), [
                'nama_pelajaran' => 'required',
                'kd_pelajaran' => 'required',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $mata_pelajaran = MataPelajaran::findOrFail($id);
            $mata_pelajaran->nama_pelajaran = $request->nama_pelajaran;
            $mata_pelajaran->kd_pelajaran = $request->kd_pelajaran;
            $mata_pelajaran->save();

            // Sweet alert
            Alert::success('Perubahan Berhasil', 'Mata pelajaran berhasil diubah.');

            return redirect()->route('matapelajaran.index');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {

            $mapel = MataPelajaran::findOrFail($id);
            $mapel->delete();

            // Sweet alert
            Alert::success('Berhasil Dihapus', 'Mata pelajaran berhasil dihapus.');

            return redirect()->route('matapelajaran.index');
        } else {
            return back();
        }
    }
}
