<?php

namespace App\Http\Controllers;

//kelas
use App\Models\Kelas;
use App\Models\Guru;


use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {

                $title = "Data Kelas";
                // $kelas = Kelas::all();
                $kelas = DB::table('kelas')->join('gurus', 'gurus.kelas_id', '=', 'kelas.id')->select('kelas.*', 'gurus.nama_guru')->orderBy('angka_kelas', 'asc')->get();

                return view('dashboard.Operational.Kelas.DataKelas', [
                    'title' => $title,
                    'kelas' => $kelas,
                ]);
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
        // $kelas_id = $id;
        // $kelas_siswa = Kelas::findOrFail($id);
        // $nama_kelas = $kelas_siswa->angka_kelas;

        // $title = "Tambah Siswa";
        // $kelas = Kelas::all();
        // return view('dashboard.Operational.Kelas.TambahDataKelas', compact('title', 'kelas', 'kelas_id', 'nama_kelas'));
        return back();
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
                'password' => 'required',
                'email' => 'required',
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
            return redirect()->route('kelas.show', $siswa->kelas_id);
        } else {
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                $guru = DB::table('siswas')  // Nama tabel harus 'siswas'
                    ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')  // Menggunakan 'siswas' bukan 'siswa'
                    ->select('siswas.*', 'kelas.angka_kelas')
                    ->where('siswas.kelas_id', $id)
                    ->get();

                $kelas_id = $id;
                $kelas_siswa = Kelas::findOrFail($id);
                $nama_kelas = $kelas_siswa->angka_kelas;

                $Title = 'Data Siswa Kelas ' . $nama_kelas;

                return view('dashboard.Operational.Kelas.MuridTiapKelas', [
                    'title' => $Title,
                    'guru' => $guru,
                    'kelas' => $kelas_id,
                ]);
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
    public function edit(string $id, string $kelas_id)
    {
        $title = "Edit Siswa";
        $kelas = Kelas::all();
        $siswa = Siswa::find($id);
        $kelas_siswa = Kelas::findOrFail($kelas_id);
        $nama_kelas = $kelas_siswa->angka_kelas;
        return view('dashboard.Operational.Kelas.EditDataKelas', compact('title', 'siswa', 'kelas', 'kelas_id', 'nama_kelas'));
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
            'password' => 'required',
            'email' => 'required',
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
        return redirect()->route('kelas.show', $siswa->kelas_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        // Hapus file foto
        if ($siswa->foto_siswa) {
            $filePath = public_path('storage/siswa/' . $siswa->foto_siswa);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $kelas_id = $siswa->kelas_id;

        $siswa->delete();

        // Sweet alert
        Alert::success('Berhasil Dihapus', 'Data Siswa berhasil dihapus.');

        return redirect()->route('kelas.show', $kelas_id);
    }

}
