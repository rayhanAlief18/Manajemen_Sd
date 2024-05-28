<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Siswa";
        $kelas = Kelas::all();
        $data = Siswa::all();
        return view('dashboard.Siswa.DataSiswa', [
            'title' => $title,
            'kelas' => $kelas,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Siswa";
        $kelas = Kelas::all();
        // return view('list-barang.create', compact('_satuan'));
        return view('dashboard.Siswa.TambahDataSiswa', compact('title', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'NISN' => 'required|unique:siswas,nisn|numeric',
            'NIK' => 'required|unique:siswas,nik|numeric',
            'NIS' => 'required|numeric  ',
            'NO_KK' => 'required|numeric',
            'nama_siswa' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'wali_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'kelas' => 'required|exists:kelas,id',

            'agama' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'anak_ke' => 'required|numeric',

            'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        ], ['NISN.unique' => 'NISN sudah ada.']);

        // Simpan data guru ke dalam basis data
        $siswa = new Siswa();
        $siswa->NISN = $request->NISN;
        $siswa->NIK = $request->NIK;
        $siswa->NIS = $request->NIS;
        $siswa->NO_KK = $request->NO_KK;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->wali_siswa = $request->wali_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->kelas_id = $request->kelas;

        $siswa->agama = $request->agama;
        $siswa->tempat = $request->tempat;
        $siswa->anak_ke = $request->anak_ke;
        // Mengelola file foto siswa
        if ($request->hasFile('foto_siswa')) {
            $image = $request->file('foto_siswa');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Menyimpan file ke direktori yang diinginkan di dalam penyimpanan publik
            $path = $image->storeAs('public/siswa', $imageName);

            // Mengupdate atribut foto_siswa dengan nama file yang disimpan
            $siswa->foto_siswa = $imageName;
        }


        // Simpan data guru
        $siswa->save();

        // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil disimpan!');
    }

    public function updateSemester(Request $request)
    {
        // Validasi request
        $request->validate([
            'siswas' => 'required|array', // Pastikan array ID siswa tidak kosong
            'siswas.*' => 'required|integer|exists:siswas,id', // Pastikan setiap ID siswa valid
        ]);

        // Ambil array ID siswa
        $idSiswas = $request->input('siswas');

        // Ambil semua data siswa berdasarkan ID
        $siswas = Siswa::whereIn('id', $idSiswas)->get();

        // Naikkan semester semua siswa
        foreach ($siswas as $siswa) {
            // Periksa nilai semester saat ini
            if ($siswa->semester === 'Semester 1') {
                $siswa->semester = 'Semester 2'; // Ubah ke semester 2
                // if ($siswa->kelas_id === 1) {
                //     $siswa->kelas_id = 4;
                // } else if ($siswa->kelas_id === 4) {
                //     $siswa->kelas_id = 5;
                // } else if ($siswa->kelas_id === 5) {
                //     $siswa->kelas_id = 6;
                // } else if ($siswa->kelas_id === 6) {
                //     $siswa->kelas_id = 7;
                // } else if ($siswa->kelas_id === 7) {
                //     $siswa->kelas_id = 8;
                // } else {
                //     $siswa->kelas_id = 10;
                // }
                // $siswa->save(); // Simpan perubahan
            } else if ($siswa->semester === 'Semester 2') {
                $siswa->semester = 'Semester 1'; // Ubah ke semester 1

                if ($siswa->kelas_id === 1) {
                    $siswa->kelas_id = 4;
                } else if ($siswa->kelas_id === 4) {
                    $siswa->kelas_id = 5;
                } else if ($siswa->kelas_id === 5) {
                    $siswa->kelas_id = 6;
                } else if ($siswa->kelas_id === 6) {
                    $siswa->kelas_id = 7;
                } else if ($siswa->kelas_id === 7) {
                    $siswa->kelas_id = 8;
                } else {
                    $siswa->kelas_id = 10;
                }
            }

            $siswa->save(); // Simpan perubahan
        }

        // Berikan pesan sukses
        return redirect()->back()->with('success', 'Semester ' . count($siswas) . ' siswa telah diperbarui');
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
        // $pageTitle = 'Employee Detail';
        // ELOQUENT
        $title = "Edit Siswa";
        $kelas = Kelas::all();
        $siswa = Siswa::find($id);
        return view('dashboard.Siswa.EditDataSiswa', compact('title', 'siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'NISN' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'wali_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'kelas' => 'required|exists:kelas,id',

            'agama' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'anak_ke' => 'required|numeric',
            'semester' => 'required|in:Semester 1,Semester 2',

            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        ]);

        // Temukan data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);

        // Update data siswa
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->NISN = $request->NISN;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->wali_siswa = $request->wali_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->kelas_id = $request->kelas;
        $siswa->agama = $request->agama;
        $siswa->tempat = $request->tempat;
        $siswa->anak_ke = $request->anak_ke;
        $siswa->semester = $request->semester;

        // Mengelola file foto siswa
        if ($request->hasFile('foto_siswa')) {
            $image = $request->file('foto_siswa');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Menyimpan file ke direktori yang diinginkan di dalam penyimpanan publik
            $path = $image->storeAs('public/siswa', $imageName);

            // Mengupdate atribut foto_siswa dengan nama file yang disimpan
            $siswa->foto_siswa = $imageName;
        }


        // Simpan data siswa yang telah diupdate
        $siswa->save();

        // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::find($id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Di Hapus');
    }
}
