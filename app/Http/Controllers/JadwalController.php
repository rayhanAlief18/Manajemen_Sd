<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

//model
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Jadwal;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id = null)
    {
        //
        $title = "Daftar Kelas";
        // $jadwal = Jadwal::all();
        $kelas = DB::table('kelas')
        ->join('gurus', 'gurus.kelas_id', '=', 'kelas.id')
        ->select('kelas.*', 'gurus.nama_guru')
        ->get();
        
        
        return view('dashboard.Jadwal.index',[
            'title'=>$title,
            'kelas'=>$kelas

            // 'kelas'=>$kelas,
            // 'DataGuru'=>$DataGuru,
            // 'mapel'=>$mapel,
            // 'jadwal'=>$jadwal,
            // 'DataGuru'=>$DataGuru,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Input Data Jadwal Pelajaran";
        // $DataGuru = Guru::all();
        $DataGuru = DB::table('gurus')->join('kelas', 'gurus.kelas_id','=','kelas.id')->select('gurus.*','kelas.angka_kelas')->get();

        $mapel = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('dashboard.Jadwal.TambahDataJadwal',[
            'title'=>$title,
            'DataGuru'=>$DataGuru,
            'mapel'=>$mapel,
            'kelas'=>$kelas,
        ]);
    }

    public function tambahJadwal(string $id_kelas, $id_guru){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_mapel.required' => 'Mata pelajaran harus dipilih.',
            'id_guru.required' => 'Guru pengampu harus dipilih.',
            'id_kelas.required' => 'Kelas harus dipilih.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'jumlah_sesi.required' => 'Jumlah sesi harus diisi.',
            'jumlah_sesi.min' => 'Jumlah sesi minimal adalah 1.',
        ];
        $validator = Validator::make($request->all(), [
            'id_mapel'     => 'required',
            'id_guru' => 'required|exists:gurus,id',
            'id_kelas'     => 'required|exists:kelas,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jumlah_sesi' => 'required|min:1',
            'hari' => 'required|',
        ],$messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            // ELOQUENT
            $jadwal = New Jadwal;
            $jadwal->id_mapel = $request->id_mapel;
            $jadwal->id_guru = $request->id_guru;
            $jadwal->id_kelas = $request->id_kelas;
            $jadwal->jam_mulai = $request->jam_mulai;
            $jadwal->jam_selesai = $request->jam_selesai;
            $jadwal->jumlah_sesi = $request->jumlah_sesi;
            $jadwal->hari = $request->hari;
            $jadwal->save();

        //  Jadwal::create([
        //     'id_mapel'      => $id_mapel,
        //     'id_guru' => $request->id_guru,
        //     'id_kelas'     => $request->id_kelas,
        //     'jam_mulai'     => $request->jam_mulai,
        //     'jam_selesai'     => $request->jam_selesai,
        //     'jumlah_sesi'     => $request->jumlah_sesi,
        //     'hari'     => $request->hari,
        // ]);
        
        return redirect()->route('jadwal.show',$request->id_kelas)->with('Success','Data berhasil ditambahkan');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengatur locale Carbon ke bahasa Indonesia
        Carbon::setLocale('id');
        // Mengambil hari saat ini dalam bahasa Indonesia
        $currentDay = Carbon::now()->translatedFormat('l');
        $hariIni = strtolower($currentDay);

            $title="Jadwal Kelas : ";
            $jadwal = Jadwal::all();
            $DataGuru = Guru::all();
            $mapel = MataPelajaran::all();
            $kelas = Kelas::all();
            $kelasNow = Kelas::find($id);
            $kelasAbs = $id;
            $jadwal = DB::table('jadwals')->join('gurus','gurus.id','=','jadwals.id_guru')->join('kelas','kelas.id','=','jadwals.id_kelas')->join('mata_pelajarans','mata_pelajarans.id','=','jadwals.id_mapel')
                ->select('jadwals.*','jadwals.id as id_jadwal','gurus.nama_guru','kelas.angka_kelas','kelas.id as id_kelas', 'mata_pelajarans.nama_pelajaran')->where('kelas.id',$id)
                ->get();

        return view('dashboard.Jadwal.DataJadwal',[
            'title'=>$title,
            'DataGuru'=>$DataGuru,
            'mapel'=>$mapel,
            'kelas'=>$kelas,
            'kelasNow'=>$kelasNow,
            'kelasAbs'=>$kelasAbs,
            'jadwal'=>$jadwal,
            'hariIni'=> $hariIni,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title="Edit Data Jadwal";
        // $jadwal = Jadwal::all();
        $DataGuru = Guru::all();
        $mapel = MataPelajaran::all();
        $kelas = Kelas::all();
        $jadwal = DB::table('jadwals')->join('gurus','gurus.id','=','jadwals.id_guru')->join('kelas','kelas.id','=','jadwals.id_kelas')->join('mata_pelajarans','mata_pelajarans.id','=','jadwals.id_mapel')
            ->select('jadwals.*','jadwals.id as id_jadwal','gurus.nama_guru','kelas.angka_kelas','kelas.id', 'mata_pelajarans.nama_pelajaran','mata_pelajarans.id as matapelajaran_id')->where('jadwals.id',$id)
            ->first();

            // dd($mapel);
        return view('dashboard.Jadwal.DataEditJadwal',[
            'title'=>$title,
            'DataGuru'=>$DataGuru,
            'mapel'=>$mapel,
            'kelas'=>$kelas,
            'jadwal'=>$jadwal, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'id_mapel.required' => 'Mata pelajaran harus dipilih.',
            'id_guru.required' => 'Guru pengampu harus dipilih.',
            'id_kelas.required' => 'Kelas harus dipilih.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'jumlah_sesi.required' => 'Jumlah sesi harus diisi.',
            'jumlah_sesi.min' => 'Jumlah sesi minimal adalah 1.',
        ];
        $validator = Validator::make($request->all(), [
            'id_mapel'     => 'required',
            'id_guru' => 'required|exists:gurus,id',
            'id_kelas'     => 'required|exists:kelas,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jumlah_sesi' => 'required|min:1',
            'hari' => 'required|',
        ],$messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

          // Pastikan jadwal ditemukan

        $jadwal = Jadwal::find($id);
        $jadwal->id_mapel = $request->id_mapel;
        $jadwal->id_guru = $request->id_guru;
        $jadwal->id_kelas = $request->id_kelas;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->jumlah_sesi = $request->jumlah_sesi;
        $jadwal->hari = $request->hari;
        $jadwal->save();
        return redirect()->route('jadwal.show',$request->id_kelas)->with('Success','Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.show',$id)->with('Success', 'Data berhasil dihapus.');
    }
}
