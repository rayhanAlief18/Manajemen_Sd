<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    public function index()
    {
        $title = "Prestasi";
        $DataPrestasi = Prestasi::all();

        // Redirect
        return view('dashboard.Prestasi.DataPrestasi',data: compact('title', 'DataPrestasi'));
    }

    /**
     * To form create
     */
    public function create()
    {
        $title = "Tambah Prestasi";

        // Redirect
        return view('dashboard.Prestasi.CreatePrestasi',data: compact(['title']));
    }

    /**
     * Add data to database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'gambar_thumbnail' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'gambar_prestasi' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'nama_prestasi' => 'required|string',
            'anggota' => 'required|string',
            'tingkat' => 'required|string',
            'tgl_prestasi' => 'required|date',
            'deskripsi' => 'nullable|string',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'gambar_thumbnail.required' => 'Gambar thumbnail wajib diunggah.',
            'gambar_thumbnail.image' => 'Gambar thumbnail harus berupa file gambar | jpeg, png, jpg, atau svg',
            'gambar_thumbnail.max' => 'Ukuran gambar thumbnail maksimal 2MB.',
            'gambar_prestasi.image' => 'Gambar prestasi harus berupa file gambar | jpeg, png, jpg, atau svg',
            'gambar_prestasi.max' => 'Ukuran gambar prestasi maksimal 2MB.',
            'dokumentasi.*.image' => 'Setiap dokumentasi harus berupa file gambar.',
            'dokumentasi.*.mimes' => 'Setiap dokumentasi harus berformat jpeg, png, jpg, atau gif.',
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Pengisian data
        $prestasi = new Prestasi();
        $prestasi->nama_prestasi = $request->input('nama_prestasi');
        $prestasi->anggota = $request->input('anggota');
        $prestasi->tingkat = $request->input('tingkat');
        $prestasi->tgl_prestasi = $request->input('tgl_prestasi');
        $prestasi->deskripsi = $request->input('deskripsi');

        // Input gambar thumbnail
        if ($request->hasFile('gambar_thumbnail')) {
            $file = $request->file('gambar_thumbnail');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/gambar_thumbnail', $filename);
            $prestasi->gambar_thumbnail = $filename;
        }

        // Input gambar prestasi
        if ($request->hasFile('gambar_prestasi')) {
            $file = $request->file('gambar_prestasi');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/gambar_prestasi', $filename);
            $prestasi->gambar_prestasi = $filename;
        }

        // Proses penyimpanan array dokumentasi jika ada
        if ($request->hasFile('dokumentasi')) {
            $dokumentasiPaths = [];
            foreach ($request->file('dokumentasi') as $dokumentasi) {
                $filename = time().'_'.$dokumentasi->getClientOriginalName();
                $dokumentasi->storeAs('public/dokumentasi', $filename);
                $dokumentasiPaths[] = $filename;
            }
            // Menyimpan array sebagai string JSON
            $prestasi->dokumentasi = json_encode($dokumentasiPaths);
        }

        // Simpan data prestasi
        $prestasi->save();

        // Redirect
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil disimpan.');
    }


    /**
     * See data (Pop Up)
     */
    public function show(string $id)
    {
    }

    /**
     * To form update
     */
    public function edit(string $id)
    {
        // Temukan prestasi berdasarkan ID yang diberikan
        $title = "Edit Prestasi";
        $prestasi = Prestasi::query()->find((integer)$id);

        // Redirect
        return view('dashboard.Prestasi.EditPrestasi', data: compact(['title', 'prestasi']));
    }

    /**
     * Action update data
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'gambar_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'gambar_prestasi' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'nama_prestasi' => 'required|string',
            'anggota' => 'required|string',
            'tingkat' => 'required|string',
            'tgl_prestasi' => 'required|date',
            'deskripsi' => 'nullable|string',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'gambar_thumbnail.image' => 'Gambar thumbnail harus berupa file gambar | jpeg, png, jpg, atau svg',
            'gambar_thumbnail.max' => 'Ukuran gambar thumbnail maksimal 2MB.',
            'gambar_prestasi.image' => 'Gambar prestasi harus berupa file gambar | jpeg, png, jpg, atau svg',
            'gambar_prestasi.max' => 'Ukuran gambar prestasi maksimal 2MB.',
            'dokumentasi.*.image' => 'Setiap dokumentasi harus berupa file gambar.',
            'dokumentasi.*.mimes' => 'Setiap dokumentasi harus berformat jpeg, png, jpg, atau gif.',
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan entri prestasi berdasarkan ID
        $prestasi = Prestasi::findOrFail($id);

        // Update data prestasi
        $prestasi->nama_prestasi = $request->input('nama_prestasi');
        $prestasi->anggota = $request->input('anggota');
        $prestasi->tingkat = $request->input('tingkat');
        $prestasi->tgl_prestasi = $request->input('tgl_prestasi');
        $prestasi->deskripsi = $request->input('deskripsi');

        // Update gambar thumbnail jika ada
        if ($request->hasFile('gambar_thumbnail')) {
            // Hapus gambar lama jika ada
            if ($prestasi->gambar_thumbnail) {
                Storage::delete('public/gambar_thumbnail/' . $prestasi->gambar_thumbnail);
            }

            // Simpan gambar baru
            $file = $request->file('gambar_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar_thumbnail', $filename);
            $prestasi->gambar_thumbnail = $filename;
        }

        // Update gambar prestasi jika ada
        if ($request->hasFile('gambar_prestasi')) {
            // Hapus gambar lama jika ada
            if ($prestasi->gambar_prestasi) {
                Storage::delete('public/gambar_prestasi/' . $prestasi->gambar_prestasi);
            }

            // Simpan gambar baru
            $file = $request->file('gambar_prestasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar_prestasi', $filename);
            $prestasi->gambar_prestasi = $filename;
        }

        // Update dokumentasi jika ada
        if ($request->hasFile('dokumentasi')) {
            // Hapus dokumentasi lama jika ada
            if ($prestasi->dokumentasi) {
                $dokumentasiPaths = json_decode($prestasi->dokumentasi, true);
                if (is_array($dokumentasiPaths)) {
                    foreach ($dokumentasiPaths as $path) {
                        Storage::delete('public/dokumentasi/' . $path);
                    }
                }
            }

            // Simpan dokumentasi baru
            $dokumentasiPaths = [];
            foreach ($request->file('dokumentasi') as $dokumentasi) {
                $filename = time() . '_' . $dokumentasi->getClientOriginalName();
                $dokumentasi->storeAs('public/dokumentasi', $filename);
                $dokumentasiPaths[] = $filename;
            }
            // Menyimpan array sebagai string JSON
            $prestasi->dokumentasi = json_encode($dokumentasiPaths);
        }

        // Simpan perubahan
        $prestasi->save();

        // Redirect
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove data
     */
    public function destroy(string $id)
    {
        // Temukan entri prestasi berdasarkan ID
        $findPrestasi = Prestasi::query()->find((integer)$id);

        // Hapus file gambar thumbnail jika ada
        if ($findPrestasi->gambar_thumbnail) {
            Storage::delete('public/gambar_thumbnail/' . $findPrestasi->gambar_thumbnail);
        }

        // Hapus file gambar prestasi jika ada
        if ($findPrestasi->gambar_prestasi) {
            Storage::delete('public/gambar_prestasi/' . $findPrestasi->gambar_prestasi);
        }

        // Hapus file dokumentasi jika ada
        if ($findPrestasi->dokumentasi) {
            $dokumentasiPaths = json_decode($findPrestasi->dokumentasi, true);
            if (is_array($dokumentasiPaths)) {
                foreach ($dokumentasiPaths as $path) {
                    Storage::delete('public/dokumentasi/' . $path);
                }
            }
        }

        // Hapus data di database
        $findPrestasi->delete();

        // Redirect
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
