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
        $DataGuru = DB::table('gurus')->join('kelas', 'gurus.kelas', '=', 'kelas.id')
            ->select('gurus.*', 'gurus.id', 'gurus.nama_guru', 'kelas.nama_kelas', 'kelas.id as id_kelas')
            ->get();
        return view('dashboard.Guru.DataGuru', [
            'title' => $title,
            'DataGuru' => $DataGuru,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Guru";
        $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();

        return view('dashboard.Guru.TambahDataGuru', [
            'title' => $title,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
        //     'nama_guru'     => 'required|min:5',
        //     'kelas'   => 'required',
        // ]);

        // $this->validate($request, [
        //     'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
        //     'nama_guru'     => 'required|min:5',
        //     'kelas'   => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // $image  = $request->file('image');
        // $filename = date('Y-m-d').$image->getClientOriginalName();
        // $path = 'guru/'.$filename;

        // Storage::disk('public')->putFile($path,file_get_contents($image));
        // //  //create post
        // Guru::create([
        //     'foto'     => $image->hashName(),
        //     'nama_guru'     => $request->nama_guru,
        //     'kelas'   => $request->kelas
        // ]);

        // return redirect()->route('guru.index')->with(['Success' => 'Data Berhasil Disimpan!']);
        $validator = Validator::make($request->all(), [
            'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
            'nama_guru' => 'required|min:5',
            'kelas'     => 'required|unique:gurus,kelas',
        ], ['kelas.unique' => 'Kelas sudah ditempati guru lain.']);


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
            'kelas'     => $request->kelas
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
        $DataGuru = DB::table('gurus')
            ->join('kelas', 'gurus.kelas', '=', 'kelas.id')
            ->select('gurus.*', 'kelas.nama_kelas', 'kelas.id as id_kelas')
            ->where('gurus.id', $id)
            ->first();
        $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();


        return view('dashboard.Guru.EditDataGuru', [
            'title' => $title,
            'kelas' => $kelas,
            'DataGuru' => $DataGuru,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            // 'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
            'nama_guru' => 'required|min:5',
            'kelas'     => 'required|unique:gurus,kelas',
        ], ['kelas.unique' => 'Kelas sudah ditempati guru lain.']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $image = $request->file('image');
        // if($image){
        //     $filename = date('Y-m-d') . $image->getClientOriginalName();
        //     $path = 'guru/' . $filename;

        //     // Menggunakan putFile() untuk menyimpan file langsung
        //     Storage::disk('public')->put($path, file_get_contents($image));
        //     $data['image'] = $filename;
        // }

        // Guru::Where($id)->update([
        //     // 'foto'      => $filename,
        //     'nama_guru' => $request->nama_guru,
        //     'kelas'     => $request->kelas,
        // ]);

        $guru = Guru::find($id);
        $guru->nama_guru = $request->input('nama_guru');
        $guru->kelas = $request->input('kelas');
        $guru->save();

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
