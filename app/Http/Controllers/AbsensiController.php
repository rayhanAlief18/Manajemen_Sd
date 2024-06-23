<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        $title = "Data Rekap Absensi Seluruh Siswa";
        $DataAbsensiNow = DB::table('absensi')
        ->join('siswas', 'siswas.id','=','absensi.id_siswa')
        ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
        ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','siswas.nama_siswa')
        ->get();

        return view('dashboard.Absensi.ShowAllAbsensi',[
            'title'=>$title,
            'DataAbsensiNow'=>$DataAbsensiNow,
        ]);
    }

    public function ShowSiswaAbsensi($id)
    {
        // Mengatur locale Carbon ke bahasa Indonesia
        Carbon::setLocale('id');
        // Mengambil hari saat ini dalam bahasa Indonesia
        $currentDay = Carbon::now()->translatedFormat('l');
        $hariIni = strtolower($currentDay);
        $tanggalSekarang = Carbon::now()->startOfDay()->toDateString();
        $haridantanggal = $hariIni." ".$tanggalSekarang;

        $title = "Data Murid Kelas :";    
        $DataSiswa = DB::table('siswas')
        ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')->join('gurus','gurus.kelas_id','=','siswas.kelas_id')
        ->select('siswas.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','gurus.nama_guru')
        ->where('kelas.id', $id)
        ->get();

        $DataAbsensiNow = DB::table('absensi')
        ->join('siswas', 'siswas.id','=','absensi.id_siswa')
        ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
        ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','siswas.nama_siswa')
        ->where('absensi.id_kelas', $id)
        ->whereDate('absensi.date', $haridantanggal) // Hanya ambil data absensi hari ini
        ->get();


        return view('dashboard.Absensi.ShowSiswaAbsensi',[
            'title'=>$title,
            'DataSiswa'=>$DataSiswa,
            'DataAbsensiNow'=>$DataAbsensiNow,
            'hariIni'=>$hariIni,
            'tanggalSekarang'=>$tanggalSekarang,
        ]);
    }

    public function tambahAbsensiSiswa($id, Request $request)
    {
        // $image = $request->file('image');
        // $filename = date('Y-m-d') . $image->getClientOriginalName();
        // $path = 'absensi/' . $filename;
        
        // // Menggunakan putFile() untuk menyimpan file langsung
        // Storage::disk('public')->put($path, file_get_contents($image));
        // // Buat post baru setelah file disimpan

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

        if($request->status == "hadir"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'catatan'=>$request->no_kk,
                // 'foto_surat_izin'=> $filename,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "izin"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'catatan'=>$request->no_kk,
                // 'foto_surat_izin'=> $filename,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "sakit"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'catatan'=>$request->no_kk,
                // 'foto_surat_izin'=> $filename,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "tidak hadir"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'catatan'=>$request->no_kk,
                // 'foto_surat_izin'=> $filename,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
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

        if($request->status == "hadir"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "izin"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "sakit"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
        }

        if($request->status == "tidak hadir"){
            Absensi::create([
                'id_siswa' => $request->id_siswa,
                'id_kelas'=>$request->id_kelas,
                'date'=>$request->date,
                'status'=>$request->status,
                'nama_guru'=>$request->nama_guru,
            ]);
            return redirect()->route('ShowSiswaAbsensi',$id)->with(['Success' => 'Data Berhasil Disimpan!']);
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
        $title = "Tambah Catatan Dan Foto Surat Izin";
        $DataAbsensiNow = DB::table('absensi')
        ->join('siswas', 'siswas.id','=','absensi.id_siswa')
        ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
        ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','siswas.nama_siswa')
        ->where('absensi.id', $id)
        ->first();
        return view('dashboard.Absensi.EditSiswaAbsensi',[
            'title'=>$title,
            'DataAbsensiNow'=>$DataAbsensiNow,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        ],$messages);

        $DataAbsensiNow = DB::table('absensi')
        ->join('siswas', 'siswas.id','=','absensi.id_siswa')
        ->join('kelas', 'absensi.id_kelas', '=', 'kelas.id')
        ->select('absensi.*', 'kelas.angka_kelas', 'kelas.id as id_kelas','siswas.nama_siswa')
        ->where('absensi.id', $id)
        ->first();

        
        $image = $request->file('image');
        //if you upload image
        if($image){
            $filename = $DataAbsensiNow->nama_siswa. date('Y-m-d') . $image->getClientOriginalName();
            $path = 'absensi/' . $filename;
            
            // Menggunakan putFile() untuk menyimpan file langsung
            Storage::disk('public')->put($path, file_get_contents($image));

            //action image
            Absensi::Where('id',$id)->update([
                'foto_surat_izin' => $filename,
                'catatan' => $request->catatan,
            ]);
            
            return redirect()->route('ShowSiswaAbsensi',$DataAbsensiNow->id_kelas)->with(['Success' => 'Data Berhasil Disimpan!']);

        }else{
            Absensi::Where('id',$id)->update([
                'catatan' => $request->catatan,
            ]);
            
            return redirect()->route('ShowSiswaAbsensi',$DataAbsensiNow->id_kelas)->with(['Success' => 'Data Berhasil Disimpan!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
