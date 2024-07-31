<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
//model
use App\Models\Guru;
use App\Models\Kelas;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {

                $title = "Guru";
                $DataGuru = Guru::select('gurus.*', 'gurus.id', 'gurus.nama_guru', 'kelas.angka_kelas', 'kelas.id as id_kelas')->join('kelas', 'kelas.id', '=', 'gurus.kelas_id')
                ->orderBy('kelas.id', 'asc') ->get();
                return view('dashboard.Guru.DataGuru', [
                    'title' => $title,
                    'DataGuru' => $DataGuru,
                ]);
            }
            $title = "Guru";
            $DataGuru = Guru::select('gurus.*', 'gurus.id', 'gurus.nama_guru', 'kelas.angka_kelas', 'kelas.id as id_kelas')->join('kelas', 'kelas.id', '=', 'gurus.kelas_id')
                ->get();
            confirmDelete();
            return view('dashboard.Guru.DataGuru', [
                'title' => $title,
                'DataGuru' => $DataGuru,
            ]);
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $title = "Tambah Data Guru";
            $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();

            return view('dashboard.Guru.TambahDataGuru', [
                'title' => $title,
                'kelas' => $kelas,
            ]);
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $messages = [
                'image.required' => 'Foto harus diunggah.',
                'image.foto' => 'File foto harus berupa gambar.',
                'image.mimes' => 'Foto harus memiliki format: jpeg, png, jpg, gif, svg.',
                'image.max' => 'Ukuran foto maksimal adalah 2MB.',
                'nama_guru.required' => 'Nama guru harus diisi.',
                'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                'nik.required' => 'NIK harus diisi.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'nik.digits' => 'NIK harus terdiri dari 16 digit.',
                'no_kk.required' => 'Nomor KK harus diisi.',
                'no_kk.numeric' => 'Nomor KK harus berupa angka.',
                'no_kk.digits' => 'Nomor KK harus terdiri dari 16 digit.',
                'agama.required' => 'Agama harus dipilih.',
                'agama.in' => 'Agama yang dipilih tidak valid.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email harus valid.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                // 'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',
                'nomor_npwp.required' => 'Nomor NPWP harus diisi.',
                'nomor_npwp.numeric' => 'Nomor NPWP harus berupa angka.',
                'nomor_npwp.digits' => 'Nomor NPWP harus terdiri dari 16 digit.',
                'gelar_depan.string' => 'Gelar depan harus berupa teks.',
                'gelar_belakang.string' => 'Gelar belakang harus berupa teks.',
                'nomor_telepon.required' => 'Nomor Telepon harus diisi.',
                'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka.',
                'nomor_hp.required' => 'Nomor Hp harus diisi.',
                'nomor_hp.numeric' => 'Nomor HP harus berupa angka.',
                'nomor_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 15 digit.',
                'jenjang.required' => 'Jenjang harus diisi.',
                'tahun_lulus.required' => 'Tahun lulus harus diisi.',
                'tahun_lulus.numeric' => 'Tahun lulus harus berupa angka.',
                'tahun_lulus.digits' => 'Tahun lulus harus terdiri dari 4 digit.',
                'jurusan.required' => 'Jurusan harus diisi.',
                // 'jabatan.required' => 'Jabatan harus diisi.',
                'kelas_id.required' => 'Kelas harus dipilih.',
                'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
                // 'role.required' => 'Role harus dipilih.',
                // 'role.in' => 'Role yang dipilih tidak valid.',
                'level.required' => 'Level harus dipilih.',
                'level.in' => 'Level yang dipilih tidak valid.',
                'status.required' => 'Status harus dipilih.',
                'status.in' => 'Status yang dipilih tidak valid.',
            ];


            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,jpg,png|max:2048',
                'nama_guru' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|numeric|digits:16',
                'no_kk' => 'required|numeric|digits:16',
                'agama' => 'required|string|in:islam,kristen,hindu,budha,khongucu',
                'email' => 'required|string|email|max:255|unique:gurus,email',
                'password' => 'required|string|min:8',
                'jenis_kelamin' => 'required|string|in:laki laki,perempuan',
                'nomor_npwp' => 'required|numeric|digits:16',
                'gelar_depan' => 'nullable|string|max:50',
                'gelar_belakang' => 'nullable|string|max:50',
                'nomor_telepon' => 'required|numeric',
                'nomor_hp' => 'required|',
                'jenjang' => 'required|string|max:100',
                'tahun_lulus' => 'required|numeric|digits:4',
                'jurusan' => 'required|string|max:100',
                // 'jabatan' => 'required|string|max:100',
                'kelas_id' => 'required|integer|exists:kelas,id',
                // 'role' => 'required|string|in:admin,guru,staff',
                'level' => 'required|string|in:kepala sekolah,tata usaha,wali kelas,guru mapel',
                'status' => 'required|string|in:aktif,nonaktif',
            ], $messages);


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
                'foto' => $filename,
                'nama_guru' => $request->nama_guru,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'agama' => $request->agama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_npwp' => $request->nomor_npwp,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'nomor_telepon' => $request->nomor_telepon,
                'nomor_hp' => $request->nomor_hp,
                'jenjang' => $request->jenjang,
                'tahun_lulus' => $request->tahun_lulus,
                'jurusan' => $request->jurusan,
                //Jabatan & Tugas
                // 'jabatan' => $request->jabatan,
                'kelas_id' => $request->kelas_id,
                // 'role' => $request->role,
                'level' => $request->level,
                'status' => $request->status,
            ]);

            // Sweet alert
            Alert::success('Berhasil Ditambahkan', 'Data Guru berhasil ditambahkan.');

            return redirect()->route('guru.index');
        } else {
            return back();
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
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $title = 'Edit Data Gurus';
            $guru = Guru::all();
            $DataGuru = DB::table('gurus')
                ->join('kelas', 'gurus.kelas_id', '=', 'kelas.id')
                ->select('gurus.*', 'kelas.angka_kelas', 'kelas.id as id_kelas')
                ->where('gurus.id', $id)
                ->first();
            $kelas = DB::table('kelas')->select('kelas.*', 'kelas.id as kelas_id')->get();


            return view('dashboard.Guru.EditDataGuru', [
                'title' => $title,
                'kelas' => $kelas,
                'DataGuru' => $DataGuru,
                'guru' => $guru,
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
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $messages = [
                'foto.required' => 'Foto harus diunggah.',
                'foto.image' => 'File foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus memiliki format: jpeg, png, jpg, gif, svg.',
                'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
                'nama_guru.required' => 'Nama guru harus diisi.',
                'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                'nik.required' => 'NIK harus diisi.',
                'nik.numeric' => 'NIK harus berupa angka.',
                'nik.digits' => 'NIK harus terdiri dari 16 digit.',
                'no_kk.required' => 'Nomor KK harus diisi.',
                'no_kk.numeric' => 'Nomor KK harus berupa angka.',
                'no_kk.digits' => 'Nomor KK harus terdiri dari 16 digit.',
                'agama.required' => 'Agama harus dipilih.',
                'agama.in' => 'Agama yang dipilih tidak valid.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email harus valid.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                // 'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',
                'nomor_npwp.numeric' => 'Nomor NPWP harus berupa angka.',
                'nomor_npwp.digits' => 'Nomor NPWP harus terdiri dari 15 digit.',
                'gelar_depan.string' => 'Gelar depan harus berupa teks.',
                'gelar_belakang.string' => 'Gelar belakang harus berupa teks.',
                'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka.',
                'nomor_telepon.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit.',
                'nomor_hp.numeric' => 'Nomor HP harus berupa angka.',
                'nomor_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 15 digit.',
                'jenjang.required' => 'Jenjang harus diisi.',
                'tahun_lulus.required' => 'Tahun lulus harus diisi.',
                'tahun_lulus.numeric' => 'Tahun lulus harus berupa angka.',
                'tahun_lulus.digits' => 'Tahun lulus harus terdiri dari 4 digit.',
                'jurusan.required' => 'Jurusan harus diisi.',
                'jabatan.required' => 'Jabatan harus diisi.',
                'kelas_id.required' => 'Kelas harus dipilih.',
                'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
                'role.required' => 'Role harus dipilih.',
                'role.in' => 'Role yang dipilih tidak valid.',
                'level.required' => 'Level harus dipilih.',
                'level.in' => 'Level yang dipilih tidak valid.',
                'status.required' => 'Status harus dipilih.',
                'status.in' => 'Status yang dipilih tidak valid.',
            ];


            $validator = Validator::make($request->all(), [
                //  'image'     => 'required|mimes:jpeg,jpg,png|max:2048',
                'nama_guru' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|numeric|digits:16',
                'no_kk' => 'required|numeric|digits:16',
                'agama' => 'required|string|in:islam,kristen,hindu,budha,khongucu',
                'password' => 'required|string|min:8',
                'jenis_kelamin' => 'required|string|in:laki laki,perempuan',
                'nomor_npwp' => 'nullable|numeric|digits:16 ',
                'gelar_depan' => 'nullable|string|max:50',
                'gelar_belakang' => 'nullable|string|max:50',
                'nomor_telepon' => 'nullable|numeric|digits_between:10,15',
                'nomor_hp' => 'nullable|numeric|digits_between:10,15',
                'jenjang' => 'required|string|max:100',
                'email' => 'required|string|email|max:255',
                'tahun_lulus' => 'required|numeric|digits:4',
                'jurusan' => 'required|string|max:100',
                'kelas_id' => 'required|integer|exists:kelas,id',
                'level' => 'required|string',
                'status' => 'required|string|in:aktif,non aktif',
            ], $messages);

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
            if ($image) {
                $filename = date('Y-m-d') . $image->getClientOriginalName();
                $path = 'guru/' . $filename;

                //delete from storage
                if ($guru->foto) {
                    // Hapus foto dari penyimpanan
                    Storage::disk('public')->delete('guru/' . $guru->foto);
                }
                // Menggunakan putFile() untuk menyimpan file langsung
                Storage::disk('public')->put($path, file_get_contents($image));

                //action image
                Guru::Where('id', $id)->update([
                    'foto' => $filename,
                    'nama_guru' => $request->nama_guru,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'agama' => $request->agama,
                    'email' => $request->email,
                    // 'password' => Hash::make($request->password),
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nomor_npwp' => $request->nomor_npwp,
                    'gelar_depan' => $request->gelar_depan,
                    'gelar_belakang' => $request->gelar_belakang,
                    'nomor_telepon' => $request->nomor_telepon,
                    'nomor_hp' => $request->nomor_hp,
                    'jenjang' => $request->jenjang,
                    'tahun_lulus' => $request->tahun_lulus,
                    'jurusan' => $request->jurusan,
                    //Jabatan & Tugas
                    'jabatan' => $request->jabatan,
                    'kelas_id' => $request->kelas_id,
                    'role' => $request->role,
                    'level' => $request->level,
                    'status' => $request->status,
                ]);

                return redirect()->route('guru.index');

            }

            Guru::Where('id', $id)->update([
                'nama_guru' => $request->nama_guru,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'agama' => $request->agama,

                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_npwp' => $request->nomor_npwp,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'nomor_telepon' => $request->nomor_telepon,
                'nomor_hp' => $request->nomor_hp,
                'jenjang' => $request->jenjang,
                'tahun_lulus' => $request->tahun_lulus,
                'jurusan' => $request->jurusan,
                //Jabatan & Tugas
                'kelas_id' => $request->kelas_id,
                'level' => $request->level,
                'status' => $request->status,
            ]);

            // Sweet alert
            
            Alert::success('Perubahan Berhasil', 'Data Guru berhasil diubah.');
            return redirect()->route('guru.index');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $guru = Guru::findOrFail($id);

            // Hapus foto dari penyimpanan
            Storage::disk('public')->delete('guru/' . $guru->foto);

            // Hapus data guru dari database
            $guru->delete();

            // Sweet alert
            Alert::success('Berhasil Dihapus', 'Data Guru berhasil dihapus.');

            return redirect()->route('guru.index');
        } else {
            return back();
        }
    }
}
