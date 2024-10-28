<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
// model
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Kelas;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {

                $title = "Data Absensi Tiap Kelas";
                $kelas = DB::table('kelas')
                    ->join('gurus', 'gurus.kelas_id', '=', 'kelas.id')
                    ->select('kelas.*', 'gurus.nama_guru')
                    ->orderBy('angka_kelas', 'asc')
                    ->get();


                return view('dashboard.Absensi.ShowAllKelas', [
                    'title' => $title,
                    'kelas' => $kelas
                ]);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function ShowSiswaAbsensi($id)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'wali kelas') {
                $iduser = intval($id);

                if ($iduser == Auth::guard('guru')->user()->kelas_id) {
                    // Mengatur locale Carbon ke bahasa Indonesia
                    Carbon::setLocale('id');
                    // Mengambil hari saat ini dalam bahasa Indonesia
                    $currentDay = Carbon::now()->translatedFormat('l');
                    $hariIni = strtolower($currentDay);
                    $tanggalSekarang = Carbon::now()->startOfDay()->toDateString();
                    $haridantanggal = $hariIni . " " . $tanggalSekarang;

                    $title = "Data Murid Kelas :";
                    $DataSiswa = DB::table('siswas')
                        ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                        ->join('gurus', 'gurus.kelas_id', '=', 'siswas.kelas_id')
                        ->select('siswas.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'gurus.nama_guru')
                        ->where('kelas.id', $id)
                        ->get();

                    $DataAbsensiNow = DB::table('absensi')
                        ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                        ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                        ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                        ->where('absensi.id_kelas', $id)
                        ->where('absensi.date', $haridantanggal)
                        ->get();

                    // dd($haridantanggal);

                    return view('dashboard.Absensi.ShowSiswaAbsensi', [
                        'title' => $title,
                        'DataSiswa' => $DataSiswa,
                        'DataAbsensiNow' => $DataAbsensiNow,
                        'hariIni' => $hariIni,
                        'tanggalSekarang' => $tanggalSekarang,
                        'haridantanggal' => $haridantanggal,
                    ]);
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

    public function tambahAbsensiSiswa($id, Request $request)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'wali kelas') {

                // Validasi input
                $validatedData = $request->validate([
                    'id_siswa' => 'required|integer|exists:siswas,id',
                    'id_kelas' => 'required|integer|exists:kelas,id',
                    'date' => 'required',
                    'status' => 'required|in:hadir,izin,sakit,tidak hadir',
                    'catatan' => 'nullable|string|max:255',
                    'nama_guru' => 'required|string|max:255',
                ], [
                    'id_siswa.required' => 'ID Siswa wajib diisi.',
                    'id_siswa.integer' => 'ID Siswa harus berupa angka.',
                    'id_siswa.exists' => 'ID Siswa tidak ditemukan.',
                    'id_kelas.required' => 'ID Kelas wajib diisi.',
                    'id_kelas.integer' => 'ID Kelas harus berupa angka.',
                    'id_kelas.exists' => 'ID Kelas tidak ditemukan.',
                    'date.required' => 'Tanggal wajib diisi.',
                    'status.required' => 'Status wajib diisi.',
                    'status.in' => 'Status tidak valid. Pilihan yang valid: hadir, izin, sakit, tidak hadir.',
                    'catatan.string' => 'Catatan harus berupa teks.',
                    'catatan.max' => 'Catatan tidak boleh lebih dari 255 karakter.',
                    'nama_guru.required' => 'Nama Guru wajib diisi.',
                    'nama_guru.string' => 'Nama Guru harus berupa teks.',
                    'nama_guru.max' => 'Nama Guru tidak boleh lebih dari 255 karakter.',
                ]);

                $existingAbsensi = Absensi::where('id_siswa', $request->id_siswa)
                    ->where('date', $request->date)
                    ->first();

                if ($existingAbsensi) {
                    return redirect()->back()->withErrors(['Msg' => 'Siswa sudah melakukan absensi pada tanggal ini.']);
                }

                if ($request->status == "hadir") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'catatan' => $request->no_kk,
                        // 'foto_surat_izin'=> $filename,
                        'nama_guru' => $request->nama_guru,
                    ]);
                    return redirect()->route('ShowSiswaAbsensi', $id)->with(['Success' => 'Data Berhasil Disimpan!']);
                }

                if ($request->status == "izin") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'catatan' => $request->no_kk,
                        // 'foto_surat_izin'=> $filename,
                        'nama_guru' => $request->nama_guru,
                    ]);
                    return redirect()->route('ShowSiswaAbsensi', $id)->with(['Success' => 'Data Berhasil Disimpan!']);
                }

                if ($request->status == "sakit") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'catatan' => $request->no_kk,
                        // 'foto_surat_izin'=> $filename,
                        'nama_guru' => $request->nama_guru,
                    ]);
                    return redirect()->route('ShowSiswaAbsensi', $id)->with(['Success' => 'Data Berhasil Disimpan!']);
                }

                if ($request->status == "tidak hadir") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'catatan' => $request->no_kk,
                        // 'foto_surat_izin'=> $filename,
                        'nama_guru' => $request->nama_guru,
                    ]);
                    return redirect()->route('ShowSiswaAbsensi', $id)->with(['Success' => 'Data Berhasil Disimpan!']);
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
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
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'wali kelas') {
                if ($request->status == "hadir") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'nama_guru' => $request->nama_guru,
                    ]);
                }

                if ($request->status == "izin") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'nama_guru' => $request->nama_guru,
                    ]);
                }

                if ($request->status == "sakit") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'nama_guru' => $request->nama_guru,
                    ]);
                }

                if ($request->status == "tidak hadir") {
                    Absensi::create([
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                        'date' => $request->date,
                        'status' => $request->status,
                        'nama_guru' => $request->nama_guru,
                    ]);
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {
            $title = "Rekap Absensi Siswa";
            $iduser = intval($id);

            // $DataAbsensiNow = DB::table('absensi')
            // ->join('siswas', 'siswas.id','=','absensi.id_siswa')
            // ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
            // ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','siswas.nama_siswa')
            // ->where('absensi.id_kelas',$id)
            // ->get();
            $DataSiswa = DB::table('siswas')
                ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')->join('gurus', 'gurus.kelas_id', '=', 'siswas.kelas_id')
                ->select('siswas.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'gurus.nama_guru')
                ->where('siswas.kelas_id', $id)
                ->get();

            if (Auth::guard('guru')->user()->level == 'wali kelas') {
                if ($iduser == Auth::guard('guru')->user()->kelas_id) {
                    return view('dashboard.Absensi.ShowAllSiswaPerKelas', [
                        'title' => $title,
                        'DataSiswa' => $DataSiswa,
                    ]);
                } else {
                    return back();
                }
            }

            return view('dashboard.Absensi.ShowAllSiswaPerKelas', [
                'title' => $title,
                'DataSiswa' => $DataSiswa,
            ]);
        } else {
            return back();
        }

    }

    public function ShowAllKelasTiapSiswa(string $id_kelas, $id_siswa)
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {
            // Ambil ID siswa dari session
            $id_siswa_session = session('id_siswa');
            $id_kelas_session = session('id_kelas');
            // dd($id_siswa_session,$id_kelas_session);

            $title = "Pilih Kelas Siswa";
            $kelas = DB::table('kelas')
                ->select('kelas.*')
                ->take(6)
                ->get();
            $id_siswas = $id_siswa;
            $id_kelass = $id_kelas;
            $iduser = intval($id_siswa_session);
            $idkelas = intval($id_kelas_session);

            if (Auth::guard('waliMurid')->check()) {
                if (Auth::guard('waliMurid')->user()->level == 'wali murid') {
                    if (Auth::guard('waliMurid')->user()->kelas_id == $id_kelas && $id_siswa == Auth::guard('waliMurid')->user()->id) {
                        return view('dashboard.Absensi.ShowAllKelasTiapSiswa', [
                            'title' => $title,
                            'kelas' => $kelas,
                            'id_siswa' => $id_siswas,
                        ]);
                    } else {
                        // dd("id_kel",Auth::guard('waliMurid')->user()->kelas_id, $idkelas, "idus",$iduser, Auth::guard('waliMurid')->user()->id);
                        return back();
                    }
                }
            } elseif (Auth::guard('guru')->check()) {
                if (Auth::guard('guru')->user()->level == 'wali kelas') {
                    if (intval($id_kelas) == intval(Auth::guard('guru')->user()->kelas_id) && intval($iduser) === intval($id_siswa)) {

                        return view('dashboard.Absensi.ShowAllKelasTiapSiswa', [
                            'title' => $title,
                            'kelas' => $kelas,
                            'id_siswa' => $id_siswas,
                        ]);
                    } else {

                        return back();
                    }

                } elseif (Auth::guard('guru')->user()->level == 'tata usaha') {
                    return view('dashboard.Absensi.ShowAllKelasTiapSiswa', [
                        'title' => $title,
                        'kelas' => $kelas,
                        'id_siswa' => $id_siswas,
                    ]);
                } else {
                    dd('a');
                    return back();
                }
            }
        } else {
            return back();
        }
    }

    public function editAbsensi($id, $id_kelas, $id_siswa, Request $request)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                $title = "Edit Absensi Siswa";
                $DataAbsensiNow = DB::table('absensi')
                    ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                    ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                    ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                    ->where('absensi.id', $id)
                    ->first();

                return view('dashboard.Absensi.EditAbsensiAdm', [
                    'title' => $title,
                    'DataAbsensiNow' => $DataAbsensiNow,
                    'id_kelas' => $id_kelas,
                    'id_siswa' => $id_siswa,
                ]);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function updateAbsensi($id, $id_kelas, $id_siswa, Request $request)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                // dd($request,$id, $id_kelas, $id_siswa);
                Absensi::Where('id', $id)->update([
                    'status' => $request->status,
                ]);
                return redirect()->route('ShowAbsensiPerSiswa', ['id_kelas' => $id_kelas, 'id_siswa' => $id_siswa])->with(['Success' => 'Data Berhasil Disimpan!']);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    // public function TransitIdSiswaHistoryAbsensi(Request $request, $id_kelas, $id_siswa)
    // {
    //     // Simpan ID siswa dalam session
    //     session(['id_siswa' => $request->input('id_siswa')]);
    //     session(['id_kelas' => $request->input('id_kelas')]);

    //     // Redirect ke halaman kedua
    //     return redirect()->route('ShowAllKelasTiapSiswa', [
    //         'id_kelas' => $id_kelas,
    //         'id_siswa' => $id_siswa,
    //     ])->with(['Success' => 'Data Berhasil Disimpan!']);
    // }

    public function TransitIdSiswaHistoryAbsensi(Request $request, $id_kelas, $id_siswa)
    {
        // Simpan ID siswa dalam session
        session(['id_siswa' => $request->input('id_siswa')]);
        session(['id_kelas' => $request->input('id_kelas')]);

        if ($request->id_siswa_tampilAbs && $request->id_kelas_tampilAbs) {
            session(['id_siswa_1' => $request->input('id_siswa_tampilAbs')]);
            session(['id_kelas_1' => $request->input('id_kelas_tampilAbs')]);

            return redirect()->route('ShowAbsensiPerSiswa', [
                'id_kelas' => $id_kelas,
                'id_siswa' => $id_siswa,
            ]);
        }
        // Redirect ke halaman kedua
        return redirect()->route('ShowAllKelasTiapSiswa', [
            'id_kelas' => $id_kelas,
            'id_siswa' => $id_siswa,
        ])->with('success', 'Data Berhasil Disimpan!');
    }

    public function ShowAbsensiPerSiswa(Request $request, string $id_kelas, string $id_siswa)
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {

            //ini isi presentase
            $TotalPertemuan = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->count();

            // total kehadiran
            $TotalPertemuanHadir = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->where('absensi.status', 'hadir')
                ->count();

            // total tidak hadir
            $TotalPertemuanTidakHadir = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->where('absensi.status', 'tidak hadir')
                ->count();

            // total tidak izin
            $TotalPertemuanIzin = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->where('absensi.status', 'izin')
                ->count();

            // total tidak sakit
            $TotalPertemuanSakit = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->where('absensi.status', 'sakit')
                ->count();

            // presentase hadir



            if ($TotalPertemuan > 0) {
                $PresentaseHadir = $TotalPertemuanHadir / $TotalPertemuan * 100;
                $PresentaseTidakHadir = $TotalPertemuanTidakHadir / $TotalPertemuan * 100;
                $PresentaseIzin = $TotalPertemuanIzin / $TotalPertemuan * 100;
                $PresentaseSakit = $TotalPertemuanSakit / $TotalPertemuan * 100;
            } else {
                $PresentaseHadir = 0;
                $PresentaseTidakHadir = 0;
                $PresentaseIzin = 0;
                $PresentaseSakit = 0;
            }

            $title = "Rekap Absensi";
            $DataAbsensiNow = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id_kelas', $id_kelas)
                ->where('absensi.id_siswa', $id_siswa)
                ->get();

            $id_siswa_session = session('id_siswa_1');
            $id_kelas_session = session('id_kelas_1');
            //ortu
            $id_siswas = intval($id_siswa);
            if (Auth::guard('waliMurid')->check()) {
                if ($id_siswas == Auth::guard('waliMurid')->user()->id) {
                    return view('dashboard.Absensi.ShowAbsensiPerSiswa', [
                        'title' => $title,
                        'DataAbsensiNow' => $DataAbsensiNow,
                        'TotalPertemuan' => $TotalPertemuan,
                        'TotalPertemuanHadir' => $TotalPertemuanHadir,
                        'PresentaseHadir' => $PresentaseHadir,
                        'TotalPertemuanTidakHadir' => $TotalPertemuanTidakHadir,
                        'PresentaseTidakHadir' => $PresentaseTidakHadir,
                        'TotalPertemuanIzin' => $TotalPertemuanIzin,
                        'PresentaseIzin' => $PresentaseIzin,
                        'TotalPertemuanSakit' => $TotalPertemuanSakit,
                        'PresentaseSakit' => $PresentaseSakit,
                        'id_kelas' => $id_kelas,
                        'id_siswa' => $id_siswa,
                    ]);
                } else {
                    return back();
                }
            }

            if (Auth::guard('guru')->check()) {
                if (Auth::guard('guru')->user()->level == "wali kelas") {
                    if (intval($id_siswa_session == intval($id_siswa) && intval($id_kelas_session) == intval($id_kelas))) {
                        return view('dashboard.Absensi.ShowAbsensiPerSiswa', [
                            'title' => $title,
                            'DataAbsensiNow' => $DataAbsensiNow,
                            'TotalPertemuan' => $TotalPertemuan,
                            'TotalPertemuanHadir' => $TotalPertemuanHadir,
                            'PresentaseHadir' => $PresentaseHadir,
                            'TotalPertemuanTidakHadir' => $TotalPertemuanTidakHadir,
                            'PresentaseTidakHadir' => $PresentaseTidakHadir,
                            'TotalPertemuanIzin' => $TotalPertemuanIzin,
                            'PresentaseIzin' => $PresentaseIzin,
                            'TotalPertemuanSakit' => $TotalPertemuanSakit,
                            'PresentaseSakit' => $PresentaseSakit,
                            'id_kelas' => $id_kelas,
                            'id_siswa' => $id_siswa,
                        ]);
                    } else {
                        // dd('err',intval($id_siswa_session) , intval($id_siswa) );
                        return back();
                    }
                } elseif (Auth::guard('guru')->user()->level == "tata usaha") {
                    return view('dashboard.Absensi.ShowAbsensiPerSiswa', [
                        'title' => $title,
                        'DataAbsensiNow' => $DataAbsensiNow,
                        'TotalPertemuan' => $TotalPertemuan,
                        'TotalPertemuanHadir' => $TotalPertemuanHadir,
                        'PresentaseHadir' => $PresentaseHadir,
                        'TotalPertemuanTidakHadir' => $TotalPertemuanTidakHadir,
                        'PresentaseTidakHadir' => $PresentaseTidakHadir,
                        'TotalPertemuanIzin' => $TotalPertemuanIzin,
                        'PresentaseIzin' => $PresentaseIzin,
                        'TotalPertemuanSakit' => $TotalPertemuanSakit,
                        'PresentaseSakit' => $PresentaseSakit,
                        'id_kelas' => $id_kelas,
                        'id_siswa' => $id_siswa,
                    ]);
                }
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
        if (Auth::guard('guru')->check()) {

            $title = "Tambah Catatan Dan Foto Surat Izin";
            $DataAbsensiNow = DB::table('absensi')
                ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                ->where('absensi.id', $id)
                ->first();
            return view('dashboard.Absensi.EditSiswaAbsensi', [
                'title' => $title,
                'DataAbsensiNow' => $DataAbsensiNow,
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
        if (Auth::guard('guru')->check()) {

            if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas') {

                $messages = [
                    'catatan.required' => 'Catatan wajib diisi.',
                    'catatan.string' => 'Catatan harus berupa teks.',
                    'catatan.max' => 'Catatan maksimal 255 karakter.',
                    'foto_surat_izin.required' => 'Foto surat izin wajib diunggah.',
                    'foto_surat_izin.image' => 'File harus berupa gambar.',
                    'foto_surat_izin.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif, svg.',
                    // 'foto_surat_izin.max' => 'Ukuran gambar maksimal 2048 kilobytes.',
                ];

                $validator = Validator::make($request->all(), [
                    'catatan' => 'required|string|max:255',
                    'foto_surat_izin' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ], $messages);

                $DataAbsensiNow = DB::table('absensi')
                    ->join('siswas', 'siswas.id', '=', 'absensi.id_siswa')
                    ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
                    ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas', 'siswas.nama_siswa')
                    ->where('absensi.id', $id)
                    ->first();


                $image = $request->file('image');
                //if you upload image
                if ($image) {
                    $filename = $DataAbsensiNow->nama_siswa . date('Y-m-d') . $image->getClientOriginalName();
                    $path = 'absensi/' . $filename;

                    // Menggunakan putFile() untuk menyimpan file langsung
                    Storage::disk('public')->put($path, file_get_contents($image));

                    //action image
                    Absensi::Where('id', $id)->update([
                        'foto_surat_izin' => $filename,
                        'catatan' => $request->catatan,
                    ]);

                    return redirect()->route('ShowSiswaAbsensi', $DataAbsensiNow->id_kelas)->with(['Success' => 'Data Berhasil Disimpan!']);

                } else {
                    Absensi::Where('id', $id)->update([
                        'catatan' => $request->catatan,
                    ]);

                    return redirect()->route('ShowSiswaAbsensi', $DataAbsensiNow->id_kelas)->with(['Success' => 'Data Berhasil Disimpan!']);

                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
