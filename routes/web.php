<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\PembayaranSppController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\JadwalController;
//operational
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiswaController;


use App\Http\Controllers\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('ex', function () { return view('dashboard.NilaiSiswa.export_PdfAll'); });
Route::get('ex', [NilaiSiswaController::class, 'exportPdfFiltered']);

// Route::middleware('guest')->group(function() {
//     Route::get('/',[AuthController::class,'index']);
//     Route::post('/',[AuthController::class,'login']);
// });


Route::middleware('guest')->group(function() {
    Route::get('/',[WebController::class,'index']);
    Route::post('/',[WebController::class,'login']);
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard')->middleware('protect');

//EXPORT NILAI ALL BY KELAS
Route::get('/nilai-siswa/export/pdf/{kelas_id}', [NilaiSiswaController::class, 'exportPdfFiltered'])->name('ExPdfAll');

//warga
Route::resource('/guru', GuruController::class)->middleware('protect');;
Route::resource('/staff', StaffController::class)->middleware('protect');;
Route::resource('/siswa', SiswaController::class)->middleware('protect');;
Route::resource('/BayarSpp', PembayaranSppController::class)->middleware('protect');;
Route::resource('/nilai', NilaiSiswaController::class)->middleware('protect');;
Route::resource('/matapelajaran', MataPelajaranController::class)->middleware('protect');;
Route::resource('jadwal', JadwalController::class)->middleware(['protect']);;
Route::resource('/prestasi', PrestasiController::class)->middleware('protect');;
Route::resource('/barang', BarangController::class)->middleware('protect');;
Route::resource('/ruangan', RuanganController::class)->middleware('protect');;
Route::resource('/absensi', AbsensiController::class)->middleware('protect');;


Route::resource('/alumni', AlumniController::class)->middleware('protect');
Route::resource('/inventaris', InventarisController::class)->middleware('protect');
//operasional
Route::resource('kelas', KelasController::class)->middleware('protect');
Route::get('/kelas/{id}/create', [KelasController::class, 'create'])->name('kelas.create')->middleware('protect');
Route::get('/kelas/{id}/edit/{kelas_id}', [KelasController::class, 'edit'])->name('kelas.edit')->middleware('protect');

Route::get('/riwayatbayar', [PembayaranSppController::class, 'riwayatBayar'])->name('RiwayatBayar')->middleware('protect');
Route::get('/BuktiRiwayarBayar/{id}', [PembayaranSppController::class, 'BuktiRiwayatBayar'])->name('BuktiRiwayatBayar')->middleware('protect');
Route::get('/ShowSiswaAbsensi/{id}', [AbsensiController::class, 'ShowSiswaAbsensi'])->name('ShowSiswaAbsensi')->middleware('protect');
Route::post('/tambahAbsensiSiswa/{id}', [AbsensiController::class, 'tambahAbsensiSiswa'])->name('tambahAbsensiSiswa')->middleware('protect');
Route::get('/ShowAllKelasTiapSiswa/{id_kelas}/{id_siswa}', [AbsensiController::class, 'ShowAllKelasTiapSiswa'])->name('ShowAllKelasTiapSiswa')->middleware('protect');
Route::get('/ShowAbsensiPerSiswa/{id_kelas}/{id_siswa}', [AbsensiController::class, 'ShowAbsensiPerSiswa'])->name('ShowAbsensiPerSiswa')->middleware('protect');
Route::get('/editAbsensi/{id}/{id_kelas}/{id_siswa}', [AbsensiController::class, 'editAbsensi'])->name('editAbsensi')->middleware('protect');
Route::put('/updateAbsensi/{id}/{id_kelas}/{id_siswa}', [AbsensiController::class,'updateAbsensi'])->name('updateAbsensi')->middleware('protect');
// Route::get('/DaftarKelas', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas')->middleware('protect');
// Route::get('/riwayatBayarById', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarByIds')->middleware('protect');
// In web.php (routes file)
Route::get('/riwayatbayar', [PembayaranSppController::class, 'riwayatBayar'])->name('RiwayatBayar');
Route::get('/ShowSiswaAbsensi/{id}', [AbsensiController::class, 'ShowSiswaAbsensi'])->name('ShowSiswaAbsensi');
Route::post('/tambahAbsensiSiswa/{id}', [AbsensiController::class, 'tambahAbsensiSiswa'])->name('tambahAbsensiSiswa');
Route::get('/ShowAllKelasTiapSiswa/{id_kelas}/{id_siswa}', [AbsensiController::class, 'ShowAllKelasTiapSiswa'])->name('ShowAllKelasTiapSiswa');
// Route::post('/TransitIdSiswaHistoryAbsensi/{id_kelas}/{id_siswa}', [AbsensiController::class, 'TransitIdSiswaHistoryAbsensi'])->name('TransitIdSiswaHistoryAbsensi');
Route::post('/TransitIdSiswaHistoryAbsensi/{id_kelas}/{id_siswa}', [AbsensiController::class, 'TransitIdSiswaHistoryAbsensi'])->name('TransitIdSiswaHistoryAbsensi');
Route::post('/TransitNilaiSiswa/{id_siswa}', [NilaiSiswaController::class, 'TransitNilaiSiswa'])->name('TransitNilaiSiswa');
Route::post('/TransitJadwal/{id_jadwal}', [JadwalController::class, 'TransitJadwal'])->name('TransitJadwal');
Route::get('/ShowAbsensiPerSiswa/{id_kelas}/{id_siswa}', [AbsensiController::class, 'ShowAbsensiPerSiswa'])->name('ShowAbsensiPerSiswa');

Route::get('/riwayatBayarById/{id}/', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarById')->middleware('protect');
Route::get('/DaftarKelas/{id}/', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas')->middleware('protect');

Route::post('/update-semester', [SiswaController::class, 'updateSemester'])->name('siswa.update-semester')->middleware('protect');

Route::get('/ruangan/lantai/{lantai}', [RuanganController::class, 'showLantai'])->name('showLantai')->middleware('protect');

Route::get('/ruangan/lantai/{lantai}', [RuanganController::class, 'showLantai'])->name('showLantai');

//EXPORT NILAI BY SISWA
Route::get('/nilai/export-pdf/{id}', [NilaiSiswaController::class, 'exportPdf'])->name('nilai.exportPdf');
Route::get('/nilai/form/{id}', [NilaiSiswaController::class, 'showForm'])->name('nilai.form');

// nilai pribadi di halaman ortu
Route::get('/NilaiSiswaPribadi/{id_siswa}', [NilaiSiswaController::class, 'NilaiSiswaPribadi'])->name('NilaiSiswaPribadi');


// Login Wali
Route::get('/loginWali', [AuthController::class, 'loginWali'])->name('loginWali');
Route::post('/loginWaliExecute', [AuthController::class, 'loginWaliExecute'])->name('loginWaliExecute');
Route::post('/loginGuruExecute', [AuthController::class, 'loginGuruExecute'])->name('loginGuruExecute');
Route::get('/loginGuru', [AuthController::class, 'loginGuru'])->name('loginGuru');

//juna 31 jul
// Prestasi View
Route::post('/ViewWeb/{id}', [PrestasiController::class, 'ViewWeb'])->name('ViewWeb');

// Prestasi View
Route::post('/BukaDaftar/{id}', [SiswaController::class, 'BukaDaftar'])->name('BukaDaftar');


// Rute untuk menampilkan form pendaftaran siswa
Route::get('/ads_siswa/create', [SiswaController::class, 'AddSiswa'])->name('ads_siswa.create');

// Rute untuk menyimpan data siswa
Route::post('/ads_siswa', [SiswaController::class, 'DaftarSiswa'])->name('ads_siswa.store');
Route::get('/web', [WebController::class, 'index'])->name('web.index');
