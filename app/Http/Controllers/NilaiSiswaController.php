<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranSpp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $title = "Data Nilai";
        $title2 = "Daftar kelas";
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $data = NilaiSiswa::all();
        return view('dashboard.NilaiSiswa.IndexNilai', [
            'title' => $title,
            'title2' => $title2,
            'kelas' => $kelas,
            // 'siswa' => $siswa,
            // 'data' => $data
        ]);
    }


    public function DaftarKelas(Request $request, $id)
    {
        // Ambil data pembayaran berdasarkan ID siswa
        $title = "Data Nilai Siswa";
        $kelas = Kelas::findOrFail($id); // Ambil data kelas berdasarkan ID
        $data = $kelas->siswa; // Mengambil data siswa yang terkait dengan kelas

        return view('dashboard.NilaiSiswa.DataNilaiSiswa', compact('data', 'title'));
    }

    public function riwayatBayar()
    {
        // Logika untuk mengambil data riwayat pembayaran
        $title = "Riwayat Pembayaran";
        $siswa = Siswa::all();
        $data = PembayaranSpp::all(); // atau sesuai dengan kebutuhan

        return view('dashboard.PembayaranSpp.RiwayatBayar', compact('data', 'title'));
    }

    public function riwayatBayarById(Request $request, $id)
    {
        // Ambil data pembayaran berdasarkan ID siswa
        $title = "Riwayat Pembayaran";
        $data = PembayaranSpp::where('siswa_id', $id)->get();

        // Ambil data siswa untuk ditampilkan di view
        $siswa = Siswa::findOrFail($id);

        return view('dashboard.PembayaranSpp.RiwayatById', compact('data', 'siswa', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {

        // return view('pembayaran.create', compact('siswa'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'tahun_ajaran' => 'required|string',
        ]);

        // Menggunakan siswa_id untuk menemukan siswa
        $student = Siswa::find($request->id_siswa);

        // Cek apakah nilai untuk kombinasi semester, tahun ajaran, siswa_id, dan pelajaran_id sudah ada
        $existingRecord = NilaiSiswa::where('siswa_id', $request->id_siswa)
            ->where('pelajaran_id', $request->pelajaran_id)
            ->where('semester', $student->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->first();

        if ($existingRecord) {
            // Jika sudah ada, kembalikan dengan pesan error
            return redirect()->back()->withErrors(['tahun_ajaran' => 'Nilai untuk tahun ajaran tersebut sudah ada.'])->withInput();
        }

        // Jika tidak ada, lanjutkan menyimpan data baru
        $nilai_siswa = new NilaiSiswa();
        $nilai_siswa->siswa_id = $request->id_siswa;
        $nilai_siswa->pelajaran_id = $request->pelajaran_id;
        $nilai_siswa->semester = $student->semester;
        $nilai_siswa->tahun_ajaran = $request->tahun_ajaran;
        $nilai_siswa->save();

        // Setelah menyimpan, arahkan ke halaman detail nilai siswa
        // return redirect()->route('nilai.showNilaiID')->with('success', 'Grade created successfully.');
        return redirect()->route('nilai.show', ['nilai' => $student])->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Request $request, $id)
    // {
    //     $tagihan = PembayaranSpp::with('siswa')->where('siswa_id', $request->siswa_id)
    //     -> get();
    //     dd($tagihan);

    //     // $title = "Data Pembayaran";
    //     // $siswa = Siswa::findOrFail($id);
    //     // $kelas = Kelas::all();
    //     // $data = PembayaranSpp::all();
    //     // return view('dashboard.PembayaranSpp.TambahBayarSPP', compact('title', 'siswa', 'data', 'kelas'));
    // }

    public function show(Request $request, $id)
    {
        // Mengambil parameter query string
        $nisn = $request->query('nisn');
        $nama_siswa = $request->query('nama_siswa');

        // Menggunakan model MataPelajaran untuk mendapatkan semua mata pelajaran
        $mapel = MataPelajaran::all();

        // Filter NilaiSiswa berdasarkan siswa_id
        $tagihan = NilaiSiswa::with('siswa')->where('siswa_id', $id)->get();

        // Mendefinisikan variabel untuk tampilan
        $title = "Data Nilai Siswa";
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();

        // Hanya mengambil nilai siswa yang sesuai dengan ID siswa
        $data = NilaiSiswa::where('siswa_id', $id)->get();

        // Mengembalikan view dengan data yang diperlukan
        return view('dashboard.NilaiSiswa.TambahNilaiSiswa', compact('title', 'siswa', 'data', 'kelas', 'mapel'))->with('success', 'Data siswa berhasil diperbarui!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $pageTitle = 'Employee Detail';
        // ELOQUENT
        $title = "Edit Nilai Siswa";
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        // $data = NilaiSiswa::where('siswa_id', $id)->get();
        $data = NilaiSiswa::find($id);
        return view('dashboard.NilaiSiswa.EditNilai', compact('title', 'data', 'siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Menemukan data NilaiSiswa berdasarkan ID
        $nilai = NilaiSiswa::findOrFail($id);

        // Memperbarui data NilaiSiswa
        $nilai->KI1_1 = $request->input('KI1_1');
        $nilai->KI1_2 = $request->input('KI1_2');
        $nilai->KI1_3 = $request->input('KI1_3');
        $nilai->KI1_4 = $request->input('KI1_4');
        $nilai->KI1_5 = $request->input('KI1_5');
        $nilai->KI1_6 = $request->input('KI1_6');

        $nilai->KI2_1 = $request->input('KI2_1');
        $nilai->KI2_2 = $request->input('KI2_2');
        $nilai->KI2_3 = $request->input('KI2_3');
        $nilai->KI2_4 = $request->input('KI2_4');
        $nilai->KI2_5 = $request->input('KI2_5');
        $nilai->KI2_6 = $request->input('KI2_6');

        $nilai->KI3_1 = $request->input('KI3_1');
        $nilai->KI3_2 = $request->input('KI3_2');
        $nilai->KI3_3 = $request->input('KI3_3');
        $nilai->KI3_4 = $request->input('KI3_4');
        $nilai->KI3_5 = $request->input('KI3_5');
        $nilai->KI3_6 = $request->input('KI3_6');

        $nilai->KI4_1 = $request->input('KI4_1');
        $nilai->KI4_2 = $request->input('KI4_2');
        $nilai->KI4_3 = $request->input('KI4_3');
        $nilai->KI4_4 = $request->input('KI4_4');
        $nilai->KI4_5 = $request->input('KI4_5');
        $nilai->KI4_6 = $request->input('KI4_6');

        // Menyimpan data yang telah diperbarui
        $nilai->save();

        // Mendapatkan ID siswa yang terkait
        $siswaId = $nilai->siswa_id;

        // Mengarahkan ke rute 'nilai.show' dengan parameter 'nilai' (id siswa)
        return redirect()->route('nilai.show', ['nilai' => $siswaId])->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $nilai_siswa = NilaiSiswa::findOrFail($id);
        $nilai_siswa->delete();
        $siswaId = $nilai_siswa->siswa_id;

        return redirect()->route('nilai.show', ['nilai' => $siswaId])->with('success', 'Data nilai siswa berhasil dihapus.');
    }
}
