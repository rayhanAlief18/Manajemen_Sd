<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class RuanganController extends Controller
{
    public function index($lantai = 'Lantai 1')
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                return redirect()->route('showLantai', ['lantai' => 'Lantai 1']);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Manage Lantai
     */
    public function showLantai($lantai)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                $title = "Ruangan";
                $dataRuangan = Ruangan::where('lantai', $lantai)->get();

                confirmDelete();

                // Redirect
                return view('dashboard.Sarpra.DataRuangan', compact('dataRuangan', 'lantai', 'title'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * To form create
     */
    public function create(Request $request)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                $title = "Tambah Ruangan";
                $lantai = $request->query('lantai', 'Lantai 1');

                // Redirect
                return view('dashboard.Sarpra.createRuangan', compact('title', 'lantai'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    /**
     * Add data to database
     */
    public function store(Request $request)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                $messages = [
                    'nama.required' => 'Nama harus diisi.',
                    'nama.string' => 'Nama harus berupa teks.',
                    'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
                    'deskripsi.string' => 'Deskripsi harus berupa teks.',
                    'lantai.required' => 'Lantai harus dipilih.',
                    'lantai.in' => 'Pilihan lantai tidak valid. Pilih antara: Lantai 1, Lantai 2, atau Lantai 3.',
                ];
                // Validasi input
                $validator = Validator::make($request->all(), [
                    'nama' => 'required|string|max:100',
                    'deskripsi' => 'nullable|string',
                    'lantai' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
                ], $messages);

                // Jika validasi gagal, kembalikan pesan error
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Simpan data ke database
                $ruangan = new Ruangan();
                $ruangan->nama = $request->input('nama');
                $ruangan->deskripsi = $request->input('deskripsi');
                $ruangan->lantai = $request->input('lantai');
                $ruangan->save();

                // Sweet alert
                Alert::success('Berhasil Ditambahkan', 'Ruangan berhasil ditambahkan.');

                // Redirect
                return redirect()->route('showLantai', $ruangan->lantai);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * See data (Pop Up)
     */
    public function show(string $id)
    {
    }

    /**
     * To form update
     */
    public function edit(string $id)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                // Find ruangan by id
                $ruangan = Ruangan::query()->find((integer) $id);
                $lantai = $ruangan->lantai;
                $title = "Edit Ruangan";

                // Redirect
                return view('dashboard.Sarpra.EditRuangan', data: compact(['ruangan', 'title', 'lantai']));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Action update data
     */
    public function update(Request $request, string $id)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                // Validasi input
                $messages = [
                    'nama.required' => 'Nama harus diisi.',
                    'nama.string' => 'Nama harus berupa teks.',
                    'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
                    'deskripsi.string' => 'Deskripsi harus berupa teks.',
                    'lantai.required' => 'Lantai harus dipilih.',
                    'lantai.in' => 'Pilihan lantai tidak valid. Pilih antara: Lantai 1, Lantai 2, atau Lantai 3.',
                ];

                $validator = Validator::make($request->all(), [
                    'nama' => 'required|string|max:100',
                    'deskripsi' => 'nullable|string',
                    'lantai' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
                ], $messages);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // First find by id
                $ruangan = Ruangan::findOrFail($id);

                // Update data use fill
                $ruangan->fill($request->only(['nama', 'deskripsi', 'lantai']));
                $ruangan->save();

                // Sweet alert
                Alert::success('Perubahan Berhasil', 'Ruangan berhasil diubah.');

                // Redirect
                return redirect()->route('showLantai', $ruangan->lantai);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    /**
     * Remove data
     */
    public function destroy(string $id)
    {
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->level == 'tata usaha') {
                // Find by id
                $findRuangan = Ruangan::findOrFail((integer) $id);
                $lantai = $findRuangan->lantai;

                // Delete ruangan
                $findRuangan->delete();

                // Sweet alert
                Alert::success('Berhasil Dihapus', 'Ruangan berhasil dihapus.');

                // Redirect
                return redirect()->route('showLantai', $lantai);
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

}
