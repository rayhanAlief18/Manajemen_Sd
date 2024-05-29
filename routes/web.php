<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PembayaranSppController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\InventarisController;
//operational
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiSiswaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[HomeController::class,'dashboard']);

//warga
Route::resource('guru', GuruController::class);
Route::resource('/staff', StaffController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/BayarSpp', PembayaranSppController::class);
Route::resource('/nilai', NilaiSiswaController::class);
// Route::get('/BayarSpp/{siswa_id}', [PembayaranSppController::class, 'create'])->name('pembayaran.create');
// Route::get('/BayarSpp/create/{id}', [App\Http\Controllers\PembayaranSppController::class, 'create']);


Route::resource('/alumni', AlumniController::class);
Route::resource('/inventaris', InventarisController::class);
//operasional
Route::resource('kelas', KelasController::class);

Route::get('/riwayatbayar', [PembayaranSppController::class, 'riwayatBayar'])->name('RiwayatBayar');
// Route::get('/DaftarKelas', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas');
// Route::get('/riwayatBayarById', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarByIds');
// In web.php (routes file)

Route::get('/riwayatBayarById/{id}/', [PembayaranSppController::class, 'riwayatBayarById'])->name('riwayatBayarById');
Route::get('/DaftarKelas/{id}/', [NilaiSiswaController::class, 'DaftarKelas'])->name('DaftarKelas');

Route::post('/update-semester', [SiswaController::class, 'updateSemester'])->name('siswa.update-semester');

