<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        // none
    }

    /**
     * To form crate
     */
    public function create(Request $request)
    {
        $title = "Tambah Barang";
        $lantai = $request->query('lantai', 'Lantai 1');
        $ruangan = Ruangan::where('lantai', $lantai)->get();

        // Redirect
        return view('dashboard.Sarpra.Barang.createBarang', compact('title', 'lantai', 'ruangan'));
    }

    /**
     * Add data to database
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'barang_baik' => 'required|integer|min:0',
            'barang_rusak' => 'required|integer|min:0',
            'deskripsi' => 'nullable',
            'ruangan_id' => 'required|exists:ruangans,id',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        $barang = new Barang();
        $barang->nama = $request->input('nama');
        $barang->barang_baik = $request->input('barang_baik');
        $barang->barang_rusak = $request->input('barang_rusak');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->ruangan_id = $request->input('ruangan_id');
        $barang->save();

        // Ambil nilai lantai dari ruangan_id
        $ruangan = Ruangan::findOrFail($request->input('ruangan_id'));
        $lantai = $ruangan->lantai;

        // Redirect
        return redirect()->route('showLantai', ['lantai' => $lantai])->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * See Data (Pop Pp)
     */
    public function show(string $id)
    {
    }

    /**
     * To form update
     */
    public function edit(string $id)
    {
        // Find barang by id
        $barang = Barang::query()->find((integer)$id);
        $title = "Edit Barang";

        // find lantai in barang
        $ruangan = Ruangan::findOrFail($barang->ruangan_id);
        $lantai = $ruangan->lantai;

        // find data ruangan from lantai
        $dataRuangan = Ruangan::where('lantai', $lantai)->get();

        // Redirect
        return view('dashboard.Sarpra.Barang.EditBarang', data: compact(['barang', 'title', 'lantai', 'dataRuangan']));
    }

    /**
     * Action update data
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'barang_baik' => 'required|integer|min:0',
            'barang_rusak' => 'required|integer|min:0',
            'deskripsi' => 'nullable',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // First find by id
        $barang = Barang::findOrFail($id);

        // Update data use fill
        $barang->fill($request->only(['nama', 'barang_baik', 'barang_rusak', 'deskripsi']));
        $barang->save();

        $ruangan = Ruangan::findOrFail($barang->ruangan_id);
        $lantai = $ruangan->lantai;

        // Redirect
        return redirect()->route('showLantai', $lantai)->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove data
     */
    public function destroy(string $id)
    {
        $findBarang = Barang::query()->find((integer)$id);

        // Ambil nilai lantai dari ruangan_id
        $ruangan = Ruangan::findOrFail($findBarang->ruangan_id);
        $lantai = $ruangan->lantai;

        // Delete barang
        $findBarang->delete();

        return redirect()->route('showLantai', $lantai)->with('success', 'Barang berhasil dihapus.');
    }
}
