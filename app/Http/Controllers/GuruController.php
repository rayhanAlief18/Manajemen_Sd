<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//model
use App\Models\Guru;
use App\Models\Kelas;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Guru";
        $DataGuru = Guru::select('gurus.*', 'gurus.id','gurus.nama_guru','kelas.angka_kelas','kelas.id as id_kelas')->join('kelas','kelas.id','=','gurus.kelas_id')
                ->get();
        return view('dashboard.Guru.DataGuru',[
            'title'=>$title,
            'DataGuru'=>$DataGuru,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Guru";
        $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();

        return view('dashboard.Guru.TambahDataGuru',[
            'title'=>$title,
            'kelas'=>$kelas,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $messages = [
            'kelas_id.unique' => 'Kelas sudah ditempati guru lain',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari 16 karakter.',
            'agama.required' => 'Agama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nomor_npwp.required' => 'Nomor NPWP wajib diisi.',
            'gelar_depan.required' => 'Gelar depan wajib diisi.',
            'gelar_belakang.required' => 'Gelar belakang wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'jenjang.required' => 'Jenjang wajib diisi.',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits' => 'Tahun lulus harus berupa 4 digit.',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
            'tahun_lulus.min' => 'Tahun lulus minimal adalah 1900.',
            'tahun_lulus.max' => 'Tahun lulus maksimal adalah tahun ini.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'kelas_id.required' => 'Kelas wajib diisi.',
            'role.required' => 'Role wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];


        $validator = Validator::make($request->all(), [
            'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
            'nama_guru' => 'required|min:5',
            'jabatan' => 'required',
            'kelas_id'     => 'required|unique:gurus,kelas_id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|string|max:16',
            'no_kk' => 'required|string|max:16',
            'agama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'nomor_npwp' => 'required|string|max:255',
            'gelar_depan' => 'required|string|max:255',
            'gelar_belakang' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'jurusan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ],$messages);
        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $filename = date('Y-m-d') . $image->getClientOriginalName();
        $path = 'guru/' . $filename;
        
        // Menggunakan putFile() untuk menyimpan file langsung
        Storage::disk('public')->put($path, file_get_contents($image));
        // Buat post baru setelah file disimpan
        Guru::create([
            'foto'      => $filename,
            'nama_guru' => $request->nama_guru,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'nik'=>$request->nik,
            'no_kk'=>$request->no_kk,
            'agama'=>$request->agama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'nomor_npwp'=>$request->nomor_npwp,
            'gelar_depan'=>$request->gelar_depan,
            'gelar_belakang'=>$request->gelar_belakang,
            'nomor_telepon'=>$request->nomor_telepon,
            'nomor_hp'=>$request->nomor_hp,
            'jenjang'=>$request->jenjang,
            'tahun_lulus'=>$request->tahun_lulus,
            'jurusan'=>$request->jurusan,
            //Jabatan & Tugas
            'jabatan'=>$request->jabatan,
            'kelas_id'=>$request->kelas_id,
            'role'=>$request->role,
            'status'=>$request->status,


        ]);
        
        return redirect()->route('guru.index')->with(['Success' => 'Data Berhasil Disimpan!']);
        
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
        $title = 'Edit Data Gurus';
        $guru = Guru::all();
        $DataGuru = DB::table('gurus')
        ->join('kelas', 'gurus.kelas_id', '=', 'kelas.id')
        ->select('gurus.*', 'kelas.angka_kelas', 'kelas.id as id_kelas')
        ->where('gurus.id', $id)
        ->first();
        $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();
        

        return view('dashboard.Guru.EditDataGuru',[
            'title'=>$title,
            'kelas'=>$kelas,
            'DataGuru'=>$DataGuru,
            'guru'=>$guru,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $messages = [
            'kelas_id.unique' => 'Kelas sudah ditempati guru lain',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari 16 karakter.',
            'agama.required' => 'Agama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nomor_npwp.required' => 'Nomor NPWP wajib diisi.',
            'gelar_depan.required' => 'Gelar depan wajib diisi.',
            'gelar_belakang.required' => 'Gelar belakang wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'jenjang.required' => 'Jenjang wajib diisi.',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits' => 'Tahun lulus harus berupa 4 digit.',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
            'tahun_lulus.min' => 'Tahun lulus minimal adalah 1900.',
            'tahun_lulus.max' => 'Tahun lulus maksimal adalah tahun ini.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'kelas_id.required' => 'Kelas wajib diisi.',
            'role.required' => 'Role wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];


        $validator = Validator::make($request->all(), [
            //  'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
            'nama_guru' => 'required|min:5',
            'jabatan' => 'required',
            'kelas_id'     => 'required',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|string|max:16',
            'no_kk' => 'required|string|max:16',
            'agama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'nomor_npwp' => 'required|string|max:255',
            'gelar_depan' => 'required|string|max:255',
            'gelar_belakang' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'jurusan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //find data by id
        $guru = Guru::find($id);
        
        // //request from input
        // $guru['nama_guru'] = $request->nama_guru;
        // $guru['kelas_id'] = $request->kelas;
        // $guru['jabatan'] = $request->jabatan;

        $image = $request->file('image');
        //if you upload image
        if($image){
            $filename = date('Y-m-d') . $image->getClientOriginalName();
            $path = 'guru/' . $filename;
            
            //delete from storage
            if($guru->foto){
                // Hapus foto dari penyimpanan
                Storage::disk('public')->delete('guru/' . $guru->foto);
            }
            // Menggunakan putFile() untuk menyimpan file langsung
            Storage::disk('public')->put($path, file_get_contents($image));

            //action image
            Guru::Where('id',$id)->update([
                'foto'      => $filename,
                'nama_guru' => $request->nama_guru,
                'tempat_lahir'=>$request->tempat_lahir,
                'tanggal_lahir'=>$request->tanggal_lahir,
                'nik'=>$request->nik,
                'no_kk'=>$request->no_kk,
                'agama'=>$request->agama,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'nomor_npwp'=>$request->nomor_npwp,
                'gelar_depan'=>$request->gelar_depan,
                'gelar_belakang'=>$request->gelar_belakang,
                'nomor_telepon'=>$request->nomor_telepon,
                'nomor_hp'=>$request->nomor_hp,
                'jenjang'=>$request->jenjang,
                'tahun_lulus'=>$request->tahun_lulus,
                'jurusan'=>$request->jurusan,
                //Jabatan & Tugas
                'jabatan'=>$request->jabatan,
                'kelas_id'=>$request->kelas_id,
                'role'=>$request->role,
                'status'=>$request->status,
            ]);
            
            return redirect()->route('guru.index')->with(['Success' => 'Data Berhasil Diubah !']);
        }
        
        Guru::Where('id',$id)->update([
            'nama_guru' => $request->nama_guru,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'nik'=>$request->nik,
            'no_kk'=>$request->no_kk,
            'agama'=>$request->agama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'nomor_npwp'=>$request->nomor_npwp,
            'gelar_depan'=>$request->gelar_depan,
            'gelar_belakang'=>$request->gelar_belakang,
            'nomor_telepon'=>$request->nomor_telepon,
            'nomor_hp'=>$request->nomor_hp,
            'jenjang'=>$request->jenjang,
            'tahun_lulus'=>$request->tahun_lulus,
            'jurusan'=>$request->jurusan,
            //Jabatan & Tugas
            'jabatan'=>$request->jabatan,
            'kelas_id'=>$request->kelas_id,
            'role'=>$request->role,
            'status'=>$request->status,
        ]);
        
        return redirect()->route('guru.index')->with(['Success' => 'Data Berhasil Diubah!']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);
        
        // Hapus foto dari penyimpanan
        Storage::disk('public')->delete('guru/' . $guru->foto);
        
        // Hapus data guru dari database
        $guru->delete();
        
        return redirect()->route('guru.index')->with('Success', 'Data berhasil dihapus.');
    }
}
