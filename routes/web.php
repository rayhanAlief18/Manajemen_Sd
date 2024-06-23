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

Route::middleware('guest')->group(function() {
    Route::get('/',[AuthController::class,'index']);
    Route::post('/',[AuthController::class,'login']);
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

//warga
Route::resource('/guru', GuruController::class)->middleware('protect');;
Route::resource('/staff', StaffController::class)->middleware('protect');;
Route::resource('/siswa', SiswaController::class)->middleware('protect');;
Route::resource('/BayarSpp', PembayaranSppController::class)->middleware('protect');;
Route::resource('/nilai', NilaiSiswaController::class)->middleware('protect');;
Route::resource('/matapelajaran', MataPelajaranController::class)->middleware('protect');;
Route::resource('jadwal', JadwalController::class)->middleware('protect');;
Route::resource('/prestasi', PrestasiController::class)->middleware('protect');;
Route::resource('/barang', BarangController::class)->middleware('protect');;
Route::resource('/ruangan', RuanganController::class)->middleware('protect');;
Route::resource('/absensi', AbsensiController::class)->middleware('protect');;
// Route::get('/BayarSpp/{siswa_id}', [PembayaranSppController::class, 'create'])->name('pembayaran.create');
// Route::get('/BayarSpp/create/{id}', [App\Http\Controllers\PembayaranSppController::class, 'create']);


Route::resource('/alumni', AlumniController::class);
Route::resource('/inventaris', InventarisController::class);
//operasional
Route::resource('kelas', KelasController::class);

Route::get('/riwayatbayar', [PembayaranSppController::class, 'riwayatBayar'])->name('RiwayatBayar');
Route::get('/ShowSiswaAbsensi/{id}', [AbsensiController::class, 'ShowSiswaAbsensi'])->name('ShowSiswaAbsensi');
Route::post('/tambahAbsensiSiswa/{id}', [AbsensiController::class, 'tambahAbsensiSiswa'])->name('tambahAbsensiSiswa');
// Route::get('/DaftarKelas', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas');
// Route::get('/riwayatBayarById', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarByIds');
// In web.php (routes file)

Route::get('/riwayatBayarById/{id}/', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarById');
Route::get('/DaftarKelas/{id}/', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas');

Route::post('/update-semester', [SiswaController::class, 'updateSemester'])->name('siswa.update-semester');

Route::get('/ruangan/lantai/{lantai}', [RuanganController::class, 'showLantai'])->name('showLantai');
