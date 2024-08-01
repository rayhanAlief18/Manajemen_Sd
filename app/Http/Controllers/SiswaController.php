<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Landing_Page;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
            $landing_page = Landing_Page::all();
            $title = "Data Siswa";
            $kelas = Kelas::all();
            $data = Siswa::orderBy('kelas_id')->get();
            confirmDelete();
            return view('dashboard.Siswa.DataSiswa', [
                'title' => $title,
                'kelas' => $kelas,
                'data' => $data,
                'landing_page' => $landing_page,
            ]);
        } elseif (Auth::guard('guru')->user()->level == 'wali kelas') {
            $kelas = Kelas::all();
            $data = Siswa::where('kelas_id', Auth::guard('guru')->user()->kelas_id)->get();
            $title = "Data Siswa";
            return view('dashboard.Siswa.DataSiswa', [
                'title' => $title,
                'kelas' => $kelas,
                'data' => $data
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {

            $title = "Tambah Siswa";
            $kelas = Kelas::all();
            // return view('list-barang.create', compact('_satuan'));
            return view('dashboard.Siswa.TambahDataSiswa', compact('title', 'kelas'));
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
            // Validasi data yang diterima dari form

            $customMessages = [
                'NISN.required' => 'NISN wajib diisi.',
                'NISN.unique' => 'NISN sudah terdaftar.',
                'NIK.required' => 'NIK wajib diisi.',
                'NIK.unique' => 'NIK sudah terdaftar.',
                'NIS.required' => 'NIS wajib diisi.',
                'NO_KK.required' => 'Nomor Kartu Keluarga wajib diisi.',
                'nama_siswa.required' => 'Nama siswa wajib diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'wali_siswa.required' => 'Nama wali siswa wajib diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'kelas_id.required' => 'Kelas wajib dipilih.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Password wajib diisi.',
                'agama.required' => 'Agama wajib diisi.',
                'tempat.required' => 'Tempat lahir wajib diisi.',
                'anak_ke.required' => 'Anak keberapa wajib diisi.',
                'anak_ke.integer' => 'Anak keberapa harus berupa angka.'
            ];

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
                'password'=>'required',
                'email'=>'required',
                'agama' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'anak_ke' => 'required',

                'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
            ], $customMessages);

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
            $siswa->email = $request->email;
            $siswa->password = Hash::make($request->password);

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


            // Simpan data siswa
            $siswa->save();

            // Sweet alert
            Alert::success('Berhasil Ditambahkan', 'Data Siswa berhasil ditambahkan.');

            // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
            return redirect()->route('siswa.index');
        } else {
            return back();
        }
    }

    public function updateSemester(Request $request)
    {
        if (Auth::guard('guru')->user()->level == 'tata usaha') {
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

            // Sweet alert
            Alert::success('Semua Siswa Naik Kelas', 'Semua siswa berhasil naik kelas.');

            // Berikan pesan sukses
            return redirect()->back();
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
        
        $customMessages = [
            'NISN.required' => 'NISN wajib diisi.',
            'NISN.unique' => 'NISN sudah terdaftar.',
            'NIK.required' => 'NIK wajib diisi.',
            'NIK.unique' => 'NIK sudah terdaftar.',
            'NIS.required' => 'NIS wajib diisi.',
            'NO_KK.required' => 'Nomor Kartu Keluarga wajib diisi.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'wali_siswa.required' => 'Nama wali siswa wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'tempat.required' => 'Tempat lahir wajib diisi.',
            'anak_ke.required' => 'Anak keberapa wajib diisi.',
            'anak_ke.integer' => 'Anak keberapa harus berupa angka.'
        ];

        // Validasi data yang diterima dari form
        // $request->validate([
        //     'nama_siswa' => 'required|string|max:255',
        //     'NISN' => 'required|numeric',
        //     'tanggal_lahir' => 'required|date',
        //     'wali_siswa' => 'required|string|max:255',
        //     'jenis_kelamin' => 'required|in:laki,perempuan',
        //     'kelas' => 'required|exists:kelas,id',

        //     'agama' => 'required|string|max:255',
        //     'tempat' => 'required|string|max:255',
        //     'anak_ke' => 'required|numeric',
        //     'semester' => 'required|in:Semester 1,Semester 2',

        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        // ]);

        $request->validate([
            'NISN' => 'required|numeric',
            'NIK' => 'required|numeric',
            'NIS' => 'required|numeric  ',
            'NO_KK' => 'required|numeric',
            'nama_siswa' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'wali_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'kelas' => 'required|exists:kelas,id',
            'password'=>'required',
            'email'=>'required',
            'agama' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'anak_ke' => 'required',

            // 'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        ], $customMessages);

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
        $siswa->email = $request->email;
        $siswa->password = Hash::make($request->password);

        $siswa->anak_ke = $request->anak_ke;
        $siswa->semester = $request->semester;
        $siswa->NIK = $request->NIK;
        $siswa->NIS = $request->NIS;
        $siswa->NO_KK = $request->NO_KK;

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

        // Sweet alert
        Alert::success('Perubahan Berhasil', 'Data Siswa berhasil diubah.');

        // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::find($id)->delete();

        // Sweet alert
        Alert::success('Berhasil Dihapus', 'Data Siswa berhasil dihapus.');

        return redirect()->route('siswa.index');
    }

    public function BukaDaftar(string $id)
    {
        $ld_page = Landing_Page::findOrFail($id);
        if ($ld_page->status == "on") {
            $ld_page->status = 'off';
        } else {
            $ld_page->status = 'on';
        }
        $ld_page->save();

        return redirect()->route('siswa.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function AddSiswa()
    {
        $title = "Daftar Siswa baru";
        return view('dashboard.Siswa.AddSiswa', compact('title'));
    }


    public function DaftarSiswa(Request $request)
    {
        // if (Hash::check($request->password, Hash::make($request->password))) {
        //     // Password cocok
        //    dd('Password benar');
        // } else {
        //     // Password tidak cocok
        //    dd('Password salah');
        // }
        $customMessages = [
            'NIK.required' => 'NIK wajib diisi.',
            'NIK.unique' => 'NIK sudah terdaftar.',
            'NIK.numeric' => 'NIK harus berupa angka.',
            'NO_KK.required' => 'Nomor KK wajib diisi.',
            'NO_KK.numeric' => 'Nomor KK harus berupa angka.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.string' => 'Nama siswa harus berupa teks.',
            'nama_siswa.max' => 'Nama siswa tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'wali_siswa.required' => 'Nama wali siswa wajib diisi.',
            'wali_siswa.string' => 'Nama wali siswa harus berupa teks.',
            'wali_siswa.max' => 'Nama wali siswa tidak boleh lebih dari 255 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus berupa laki atau perempuan.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama tidak boleh lebih dari 255 karakter.',
            'tempat.required' => 'Tempat wajib diisi.',
            'tempat.string' => 'Tempat harus berupa teks.',
            'tempat.max' => 'Tempat tidak boleh lebih dari 255 karakter.',
            'anak_ke.required' => 'Anak ke wajib diisi.',
            'anak_ke.numeric' => 'Anak ke harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',

        ];
        // Validasi data yang diterima dari form
        // $request->validate([
        //     // 'NISN' => 'required|unique:siswas,nisn|numeric',
        //     'NIK' => 'required|numeric',
        //     // 'NIS' => 'required|numeric  ',
        //     'NO_KK' => 'required|numeric',
        //     'nama_siswa' => 'required|string|max:255',
        //     'tanggal_lahir' => 'required|date',
        //     'wali_siswa' => 'required|string|max:255',
        //     'jenis_kelamin' => 'required|in:laki,perempuan',
        //     // 'kelas' => 'required|exists:kelas,id',

        //     'agama' => 'required|string|max:255',
        //     'tempat' => 'required|string|max:255',
        //     'anak_ke' => 'required|numeric',
        //     'email' => 'required',
        //     'password' => 'required',

        //     // 'foto_siswa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan
        // ],$customMessages);

        // Simpan data guru ke dalam basis data
        $siswa = new Siswa();
        // $siswa->NISN = 0;
        // $siswa->NIS = 0;
        $siswa->kelas_id = 12;
        $siswa->NIK = $request->NIK;
        $siswa->NO_KK = $request->NO_KK;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->wali_siswa = $request->wali_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;

        $siswa->agama = $request->agama;
        $siswa->tempat = $request->tempat;
        $siswa->anak_ke = $request->anak_ke;
        $siswa->email = $request->email;
        $siswa->password = Hash::make($request->password); // Menggunakan Hash::make untuk enkripsi password
        // $siswa->password = Hash::make($request->password);
        $siswa->foto_siswa = 'none';

        // Simpan data guru
        $siswa->save();

        // Redirect ke halaman yang sesuai atau berikan respons JSON sesuai kebutuhan
        return redirect()->route('web.index')->with('success', 'Data Siswa berhasil disimpan!');
    }
}
