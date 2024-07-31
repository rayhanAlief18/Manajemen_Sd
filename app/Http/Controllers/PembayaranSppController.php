<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranSpp;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranSppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $title = "Data Pembayaran";
            $siswa = Siswa::orderBy('kelas_id')->get();
            $data = PembayaranSpp::all();
            confirmDelete();
            return view('dashboard.PembayaranSpp.DataBayarSpp', [
                'title' => $title,
                'siswa' => $siswa,
                'data' => $data
            ]);
        } else {
            return back()->with('error', 'Anda tidak bisa mengakses halaman ini');
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

    public function BuktiRiwayatBayar(string $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            // Logika untuk mengambil data riwayat pembayaran
            $title = "Bukti Pembayaran";
            $data = PembayaranSpp::findOrFail($id); // atau sesuai dengan kebutuhan

            return view('dashboard.PembayaranSpp.RiwayatBayar', compact('data', 'title'));
        } else {
            return back();
        }
    }

    public function riwayatBayarById(Request $request, $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            // Ambil data pembayaran berdasarkan ID siswa
            $title = "Riwayat Pembayaran";
            $data = PembayaranSpp::where('siswa_id', $id)->get();

            // Ambil data siswa untuk ditampilkan di view
            $siswa = Siswa::findOrFail($id);

            return view('dashboard.PembayaranSpp.RiwayatById', compact('data', 'siswa', 'title'));
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {

        // return view('pembayaran.create', compact('siswa'));
    }
    // public function create($id)
    // {
    //     $title = "Tambah Pembayaran";
    //     $siswa = Siswa::findOrFail($id);

    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $customMessages = [
                'kd_bayar.required' => 'Kode bayar wajib diisi.',
                'kd_bayar.numeric' => 'Kode bayar harus berupa angka.',
                'bulan.required' => 'Bulan wajib dipilih.',
                'bulan.string' => 'Bulan harus berupa string.',
                'tahun.required' => 'Tahun wajib diisi.',
                'tahun.numeric' => 'Tahun harus berupa angka.',
                'jumlah_pembayaran.required' => 'Jumlah pembayaran wajib diisi.',
                'jumlah_pembayaran.numeric' => 'Jumlah pembayaran harus berupa angka.',
                'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa gambar.',
                'bukti_pembayaran.required' => 'Bukti pembayaran wajib diisi.',
                'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpeg, png, jpg, gif.',
                'bukti_pembayaran.max' => 'Bukti pembayaran tidak boleh lebih dari 2048 kilobyte.',
            ];

            $request->validate([
                'kd_bayar' => 'required|numeric',
                'bulan' => 'required|string',
                'tahun' => 'required|numeric',
                'jumlah_pembayaran' => 'required|numeric',
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], $customMessages);

            // Cek apakah sudah ada entri untuk bulan dan tahun yang sama
            $existingEntry = PembayaranSpp::where('siswa_id', $request->id_siswa)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->first();

            if ($existingEntry) {
                return redirect()->back()->withErrors(['msg' => 'Pembayaran pada bulan dan tahun tersebut sudah Lunas.'])->withInput();
            }

            // Simpan data guru ke dalam basis data
            $bayar = new PembayaranSpp();
            $bayar->kd_bayar = $request->kd_bayar;
            $bayar->siswa_id = $request->id_siswa;
            $bayar->bulan = $request->bulan;
            $bayar->tahun = $request->tahun;
            $bayar->jumlah_pembayaran = $request->jumlah_pembayaran;
            // $bayar->jenis_kelamin = $request->jenis_kelamin;
            // $bayar->kelas_id = $request->kelas;

            // Mengelola file foto siswa
            if ($request->hasFile('bukti_pembayaran')) {
                $image = $request->file('bukti_pembayaran');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Menyimpan file ke direktori yang diinginkan di dalam penyimpanan publik
                $path = $image->storeAs('public/BuktiBayar', $imageName);

                // Mengupdate atribut bukti_pembayaran dengan nama file yang disimpan
                $bayar->bukti_pembayaran = $imageName;
            }

            // Sweet alert
            Alert::success('Berhasil Ditambahkan', 'Pembayaran berhasil ditambahkan.');

            // Simpan data guru
            $bayar->save();

            // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
            return redirect()->route('BayarSpp.index')->with('success', 'Data Siswa berhasil disimpan!');
        } else {
            return back();
        }
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
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            // Mengambil parameter query string
            $nisn = $request->query('nisn');
            $nama_siswa = $request->query('nama_siswa');

            // Lakukan sesuatu dengan parameter ini
            // Contoh: dd($id, $nisn, $nama_siswa);

            // Menggunakan model Tagihan dan memuat relasi siswa
            // $tagihan = PembayaranSpp::with('siswa')->where('siswa_id', $request->siswa_id)->get();

            // Mendefinisikan variabel untuk tampilan
            $title = "Data Pembayaran";
            $siswa = Siswa::findOrFail($id);
            $kelas = Kelas::all();
            $data = PembayaranSpp::all();
            // dd($request);

            // Mengembalikan view dengan data yang diperlukan
            return view('dashboard.PembayaranSpp.TambahBayarSPP', compact('title', 'siswa', 'data', 'kelas'));
        } else {
            return view('/login')->with('error', 'Anda tidak bisa mengakses halaman ini');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            // ELOQUENT
            $title = "Edit Siswa";
            $kelas = Kelas::all();
            $siswa = Siswa::all();
            $data = PembayaranSpp::find($id);
            return view('dashboard.PembayaranSpp.EditBayarSpp', compact('title', 'data', 'siswa', 'kelas'));
        } else {
            return view('/login')->with('error', 'Anda tidak bisa mengakses halaman ini');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PembayaranSpp $pembayaranSpp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembayaranSpp $pembayaranSpp)
    {
        //
    }
}
