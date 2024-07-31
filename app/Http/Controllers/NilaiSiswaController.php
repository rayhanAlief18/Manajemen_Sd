<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\PembayaranSpp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


use PDF;


class NilaiSiswaController extends Controller
{

    public function exportPdf(Request $request, $id)
    {
        // Ensure $id is valid
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak valid');
        }

        $siswa = Siswa::findOrFail($id);

        $query = NilaiSiswa::where('siswa_id', $id);

        if ($request->has('semester') && $request->semester != '') {
            $query->where('semester', $request->semester);
        }

        if ($request->has('tahun_ajaran') && $request->tahun_ajaran != '') {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $data = $query->get();

        $catatan = $query->pluck('catatan')->unique();

        $totalNilai = $data->sum('nilai');
        $countNilai = $data->count();
        $averageNilai = $countNilai > 0 ? $totalNilai / $countNilai : 0;

        $guru = DB::table('kelas')
            ->join('gurus', 'gurus.kelas_id', '=', 'kelas.id')
            ->where('kelas.id', $siswa->kelas_id)
            ->select('gurus.nama_guru')
            ->first();

        $absensi = Absensi::where('id_siswa', $id)->get();
        $izinCount = $absensi->where('status', 'izin')->count();
        $sakitCount = $absensi->where('status', 'sakit')->count();
        $alphaCount = $absensi->where('status', 'alpha')->count();

        $pdf = PDF::loadView('dashboard.NilaiSiswa.export_pdf', compact('siswa', 'data', 'totalNilai', 'averageNilai', 'request', 'guru', 'izinCount', 'sakitCount', 'alphaCount', 'catatan'));

        // return $pdf->download('Nilai '.$data->tahun_ajaran .$data->semester .$siswa->nama_siswa.'.pdf');
        return $pdf->download('Nilai ' . $siswa->nama_siswa . '.pdf');
    }


    public function exportPdfFiltered(Request $request, $kelas_id)
    {
        // Menentukan judul halaman
        $title = "Data Nilai Siswa";

        // Mendapatkan parameter filter dari request
        $tahunAjaran = $request->input('tahun_ajaran');
        $semester = $request->input('semester');
        $kategori = $request->input('kategori');

        // Mendapatkan semua data mata pelajaran
        $mapel = MataPelajaran::all();

        // Mendapatkan data siswa berdasarkan kelas_id
        $siswa = Siswa::where('kelas_id', $kelas_id)->get();

        // Mendapatkan data kelas berdasarkan kelas_id
        $kelas = Kelas::find($kelas_id);

        // Mendapatkan data nilai siswa dengan relasi mataPelajaran berdasarkan filter
        $data = NilaiSiswa::with('siswa', 'mataPelajaran')
            ->whereHas('siswa', function ($query) use ($kelas_id) {
                $query->where('kelas_id', $kelas_id);
            })
            ->where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->where('kategori', $kategori)
            ->get();

        // Mengelompokkan data nilai berdasarkan siswa
        $nilaiSiswaArray = [];
        foreach ($data as $nilai) {
            $nilaiSiswaArray[$nilai->siswa_id]['nama_siswa'] = $nilai->siswa->nama_siswa;
            $nilaiSiswaArray[$nilai->siswa_id]['nilai'][$nilai->mataPelajaran->kd_pelajaran] = $nilai->nilai;
        }

        // Render view into PDF using dompdf with landscape orientation
        $pdf = PDF::loadView('dashboard.NilaiSiswa.export_PdfAll', compact('title', 'siswa', 'data', 'kelas', 'mapel', 'nilaiSiswaArray', 'tahunAjaran', 'semester', 'kategori'))
            ->setPaper('legal', 'landscape');


        // Mengunduh file PDF
        return $pdf->download('Nilai-Kelas.pdf');
    }







    public function exportPdfAll(Request $request, $id_kelas)
    {
        $semester = $request->input('semester');
        $tahunAjaran = $request->input('tahun_ajaran');
        $kategori = $request->input('kategori');

        $nama_kelas = Kelas::where('id', $id_kelas)->value('nama_kelas');

        // Ambil semua siswa dalam kelas berdasarkan filter yang dipilih
        $siswa = Siswa::where('kelas_id', $id_kelas)->get();

        // Inisialisasi array untuk menyimpan data nilai siswa
        $dataNilai = [];

        // Loop melalui setiap siswa
        foreach ($siswa as $siswas) {
            // Ambil nilai siswa berdasarkan ID siswa dan filter yang dipilih
            $nilaiSiswa = NilaiSiswa::where('siswa_id', $siswas->id)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $tahunAjaran)
                ->where('kategori', $kategori)
                ->get();

            // Inisialisasi array untuk menyimpan nilai mata pelajaran siswa
            $nilaiArray = [];

            // Loop untuk mengambil nilai mata pelajaran
            foreach ($nilaiSiswa as $nilai) {
                // Tambahkan logika untuk mendapatkan nama mata pelajaran atau kode yang relevan
                // Contoh: $namaMapel = $nilai->mataPelajaran->nama;
                // atau jika tidak ada relasi, gunakan kolom nilai yang sesuai
                $namaMapel = $nilai->mata_pelajaran; // Sesuaikan dengan struktur tabel Anda
                $nilaiArray[$namaMapel] = $nilai->nilai;
            }

            // Menyimpan data nilai siswa ke dalam array $dataNilai
            $dataNilai[] = [
                'nama_siswa' => $siswas->nama_siswa,
                'nilai' => $nilaiArray,
            ];
        }

        // Load view untuk PDF dengan data nilai
        $pdf = PDF::loadView('dashboard.NilaiSiswa.export_PdfAll', [
            'dataNilai' => $dataNilai,
            'nama_kelas' => $nama_kelas,
            'id_kelas' => $id_kelas,
            'semester' => $semester,
            'tahunAjaran' => $tahunAjaran,
            'kategori' => $kategori,
        ]);

        // Kembalikan file PDF untuk di-download
        return $pdf->download('data-siswa.pdf');
    }






    public function showForm($id)
    {
        // Retrieve the student data
        $siswa = Siswa::findOrFail($id);

        // Get distinct semesters and years from NilaiSiswa for the student
        $semesters = NilaiSiswa::where('siswa_id', $id)
            ->distinct()
            ->pluck('semester')
            ->toArray();

        $tahunAjarans = NilaiSiswa::where('siswa_id', $id)
            ->distinct()
            ->pluck('tahun_ajaran')
            ->toArray();

        // Calculate total nilai and average nilai for the student
        $totalNilai = NilaiSiswa::where('siswa_id', $id)->sum('nilai');
        $countNilai = NilaiSiswa::where('siswa_id', $id)->count();
        $averageNilai = $countNilai > 0 ? $totalNilai / $countNilai : 0;

        // Fetch all subjects for the dropdown
        $mapel = MataPelajaran::all();

        return view('dashboard.NilaiSiswa.form', compact('siswa', 'semesters', 'tahunAjarans', 'totalNilai', 'averageNilai', 'mapel'));
    }



    public function index()
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {
            $title = "Data Nilai";
            $title2 = "Daftar kelas";
            // $kelass = Kelas::withCount('siswa')->where('angka_kelas', '<=', 6)->orderBy('angka_kelas', 'asc')->get();
            $kelass = DB::table('kelas')
                ->leftJoin('siswas', 'siswas.kelas_id', '=', 'kelas.id')
                ->leftJoin('gurus', 'gurus.kelas_id', '=', 'kelas.id')
                ->select('kelas.id', 'kelas.nama_kelas', 'kelas.angka_kelas', 'kelas.created_at', 'kelas.updated_at', 'gurus.nama_guru', DB::raw('COUNT(siswas.id) as siswa_count'))
                ->where('angka_kelas', '<=', 6)
                ->groupBy('kelas.id', 'kelas.nama_kelas', 'kelas.angka_kelas', 'kelas.created_at', 'kelas.updated_at', 'gurus.nama_guru')
                ->orderBy('angka_kelas', 'asc')
                ->get();

            $guru = Guru::with('kelas')->get();
            // $kelass = DB::table('kelas')
            //         ->join('gurus', 'gurus.kelas_id', '=', 'kelas.id')
            //         ->join('siswas', 'siswas.kelas_id','=','kelas.id')
            //         ->select('kelas.*', 'gurus.nama_guru')
            //         ->orderBy('angka_kelas', 'asc')
            //         ->get();

            confirmDelete();

            return view('dashboard.NilaiSiswa.IndexNilai', [
                'title' => $title,
                'title2' => $title2,
                'kelass' => $kelass,
                // 'guru' => $guru
            ]);
        } else {
            return back();
        }
    }

    public function DaftarKelas(Request $request, $id)
    {
        if (Auth::guard('guru')->check()) {
            $title = "Data Nilai Siswa";
            $kelas = Kelas::findOrFail($id); // Ambil data kelas berdasarkan ID
            $data = $kelas->siswa; // Mengambil data siswa yang terkait dengan kelas

            // Mendapatkan data semester unik dari nilai siswa terkait dengan kelas ini
            $smtr = NilaiSiswa::whereIn('siswa_id', $kelas->siswa->pluck('id'))
                ->distinct()
                ->pluck('semester')
                ->toArray();

            // Mendapatkan data tahun ajaran unik dari nilai siswa terkait dengan kelas ini
            $thajar = NilaiSiswa::whereIn('siswa_id', $kelas->siswa->pluck('id'))
                ->distinct()
                ->pluck('tahun_ajaran')
                ->toArray();
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                return view('dashboard.NilaiSiswa.DataNilaiSiswa', compact('data', 'title', 'kelas', 'smtr', 'thajar'));

                //     if(Auth::guard('guru')->user()->level == 'wali kelas'){
                //         if(Auth::guard('guru')->user()->kelas_id == $id){
                //             return view('dashboard.NilaiSiswa.DataNilaiSiswa', compact('data', 'title', 'kelas', 'smtr', 'thajar'));
                //         }else{
                //             return back();
                //         }
                // }
            } elseif (Auth::guard('guru')->user()->level == 'wali kelas') {
                $iduser = intval($id);
                if ($iduser == Auth::guard('guru')->user()->kelas_id) {
                    return view('dashboard.NilaiSiswa.DataNilaiSiswa', compact('data', 'title', 'kelas', 'smtr', 'thajar'));
                } else {
                    return back();
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    public function riwayatBayar()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            // Logika untuk mengambil data riwayat pembayaran
            $title = "Riwayat Pembayaran";
            $siswa = Siswa::all();
            $data = PembayaranSpp::all(); // atau sesuai dengan kebutuhan

            return view('dashboard.PembayaranSpp.RiwayatBayar', compact('data', 'title'));
        } else {
            return back();
        }
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
    //     $title = "Data Nilai Siswa";
    //     $kelas = Kelas::findOrFail($id); // Ambil data kelas berdasarkan ID
    //     $data = $kelas->siswa; // Mengambil data siswa yang terkait dengan kelas

    //     // Mendapatkan data semester unik dari nilai siswa terkait dengan kelas ini
    //     $smtr = NilaiSiswa::whereIn('siswa_id', $kelas->siswa->pluck('id'))
    //         ->distinct()
    //         ->pluck('semester')
    //         ->toArray();

    //     // Mendapatkan data tahun ajaran unik dari nilai siswa terkait dengan kelas ini
    //     $thajar = NilaiSiswa::whereIn('siswa_id', $kelas->siswa->pluck('id'))
    //         ->distinct()
    //         ->pluck('tahun_ajaran')
    //         ->toArray();

    //     return view('dashboard.NilaiSiswa.DataNilaiSiswa', compact('data', 'title', 'kelas', 'smtr', 'thajar'));
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {

        // return view('pembayaran.create', compact('siswa'));
    }


    public function store(Request $request)
    {
        $customMessages = [
            'id_siswa.required' => 'ID siswa wajib diisi.',
            'id_siswa.exists' => 'ID siswa tidak valid.',
            'pelajaran_id.required' => 'ID pelajaran wajib diisi.',
            'pelajaran_id.exists' => 'ID pelajaran tidak valid.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'tahun_ajaran.string' => 'Tahun ajaran harus berupa teks.',
            'kategori.required' => 'Kategori wajib diisi.',
            'kategori.string' => 'Kategori harus berupa teks.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.between' => 'Nilai harus antara 0 dan 100.',
            'catatan.string' => 'Catatan harus berupa teks.',
        ];

        $request->validate([
            'pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'tahun_ajaran' => 'required|string',
            'kategori' => 'required|string',
            'nilai' => 'required|integer',
        ], $customMessages);

        // Menggunakan siswa_id untuk menemukan siswa
        $student = Siswa::find($request->id_siswa);

        // Cek apakah nilai untuk kombinasi semester, tahun ajaran, siswa_id, dan pelajaran_id sudah ada
        $existingRecord = NilaiSiswa::where('siswa_id', $request->id_siswa)
            ->where('pelajaran_id', $request->pelajaran_id)
            ->where('semester', $student->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('kategori', $request->kategori)
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
        $nilai_siswa->kategori = $request->kategori;
        $nilai_siswa->nilai = $request->nilai;
        $nilai_siswa->catatan = $request->filled('catatan') ? $request->catatan : 'Tidak ada catatan';

        $nilai_siswa->save();
        // Sweet alert
        Alert::success('Berhasil Ditambahkan', 'Nilai siswa berhasil ditambahkan.');

        // Setelah menyimpan, arahkan ke halaman detail nilai siswa
        // return redirect()->route('nilai.showNilaiID')->with('success', 'Grade created successfully.');
        return redirect()->route('nilai.show', ['nilai' => $student]);
    }

    public function TransitNilaiSiswa(Request $request, $id_siswa)
    {
        if ($request->id_siswa_nilai) {
            session(['id' => $request->input('id_siswa_nilai')]);
            return redirect()->route('nilai.show', $id_siswa);
        }
    }

    public function show(Request $request, $id)
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {
            // dd($id_siswas)

            $id_siswa = session('id');
            // dd($id_siswa);

            // Mengambil parameter query string
            $nisn = $request->query('nisn');
            $nama_siswa = $request->query('nama_siswa');
            // Mendapatkan semester yang unik berdasarkan siswa_id
            $smtr = NilaiSiswa::where('siswa_id', $id)
                ->distinct()
                ->pluck('semester')
                ->toArray();

            // Mendapatkan tahun ajaran yang unik berdasarkan siswa_id
            $thajar = NilaiSiswa::where('siswa_id', $id)
                ->distinct()
                ->pluck('tahun_ajaran')
                ->toArray();

            // Mengambil parameter query string
            $nisn = $request->query('nisn');
            $nama_siswa = $request->query('nama_siswa');

            // Menggunakan model MataPelajaran untuk mendapatkan semua mata pelajaran
            $mapel = MataPelajaran::all();

            // Filter NilaiSiswa berdasarkan siswa_id dengan eager loading mataPelajaran
            $tagihan = NilaiSiswa::with(['siswa', 'kelas', 'mataPelajaran'])->where('siswa_id', $id)->get();

            $title = "Data Nilai Siswa";
            $siswa = Siswa::findOrFail($id);
            $kelas = Kelas::all();

            $data = NilaiSiswa::with('mataPelajaran')->where('siswa_id', $id)->get();

            // Mengembalikan view dengan data yang diperlukan
            // return view('dashboard.NilaiSiswa.TambahNilaiSiswa', compact('title', 'siswa', 'data', 'kelas', 'mapel', 'smtr', 'thajar'))->with('success', 'Data siswa berhasil diperbarui!');
            // Filter NilaiSiswa berdasarkan siswa_id dengan eager loading mataPelajaran, siswa, dan kelas
            $tagihan = NilaiSiswa::with(['siswa', 'kelas', 'mataPelajaran'])->where('siswa_id', $id)->get();

            // Menentukan judul halaman
            $title = "Data Nilai Siswa";

            // Mendapatkan data siswa berdasarkan id
            $siswa = Siswa::findOrFail($id);

            // Mendapatkan semua data kelas
            $kelas = Kelas::all();

            // Mendapatkan data nilai siswa dengan relasi mataPelajaran berdasarkan siswa_id
            $data = NilaiSiswa::with('mataPelajaran')->where('siswa_id', $id)->get();

            if (Auth::guard('guru')->check()) {
                if (Auth::guard('guru')->user()->level == "wali kelas") {
                    if (intval($id_siswa) == intval($id)) {
                        return view('dashboard.NilaiSiswa.TambahNilaiSiswa', compact('title', 'siswa', 'data', 'kelas', 'mapel', 'smtr', 'thajar'))->with('success', 'Data siswa berhasil diperbarui!');
                    } else {
                        return back();
                    }
                }
            }
            // Mengembalikan view dengan data yang diperlukan
            return view('dashboard.NilaiSiswa.TambahNilaiSiswa', compact('title', 'siswa', 'data', 'kelas', 'mapel', 'smtr', 'thajar'))->with('success', 'Data siswa berhasil diperbarui!');

        } else {
            return back();
        }

    }


    public function NilaiSiswaPribadi(string $id)
    {
        if (Auth::guard('waliMurid')->check()) {
            $iduser = intval($id);

            if (Auth::guard('waliMurid')->user()->id == $iduser) {
                $title = "Data Nilai Siswa";
                // Mendapatkan data nilai siswa dengan relasi mataPelajaran berdasarkan siswa_id
                $data = NilaiSiswa::with('mataPelajaran')->where('siswa_id', $id)->get();
                return view('dashboard.NilaiSiswa.NilaiSiswaPribadi', compact('title', 'data'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $pageTitle = 'Employee Detail';
        // ELOQUENT
        $title = "Edit Nilai Siswa";
        $siswa = Siswa::all();
        $kelas = Kelas::withCount('siswa')->where('angka_kelas', '<=', 6)->get();
        $guru = Guru::with('kelas')->get();
        // $data = NilaiSiswa::where('siswa_id', $id)->get();
        $data = NilaiSiswa::find($id);
        return view('dashboard.NilaiSiswa.EditNilai', compact('title', 'data', 'siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'nilai.required' => 'Nilai wajib diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'nilai' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Menemukan data NilaiSiswa berdasarkan ID
        $nilai = NilaiSiswa::findOrFail($id);

        $nilai->nilai = $request->nilai;
        $nilai->catatan = $request->filled('catatan') ? $request->catatan : 'Tidak ada catatan';

        // Menyimpan data yang telah diperbarui
        $nilai->save();

        // Mendapatkan ID siswa yang terkait
        $siswaId = $nilai->siswa_id;

        // Sweet alert
        Alert::success('Perubahan Berhasil', 'Nilai siswa berhasil diubah.');

        // Mengarahkan ke rute 'nilai.show' dengan parameter 'nilai' (id siswa)
        return redirect()->route('nilai.show', ['nilai' => $siswaId]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nilai_siswa = NilaiSiswa::findOrFail($id);
        $nilai_siswa->delete();
        $siswaId = $nilai_siswa->siswa_id;

        // Sweet alert
        Alert::success('Berhasil Dihapus', 'Nilai siswa berhasil dihapus.');

        return redirect()->route('nilai.show', ['nilai' => $siswaId]);
    }
}
