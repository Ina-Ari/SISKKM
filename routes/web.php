<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use App\Http\Controllers\tingkatKegiatanController;
use App\Http\Controllers\posisiController;
use App\Http\Controllers\poinController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('master');
// });

Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboardMhs', [dashboardController::class, 'indexMhs'])->name('dashboardMhs');
Route::get('/apijurusan', [JurusanController::class, 'fetchJurusan']);
Route::get('/apiprodi', [ProdiController::class, 'fetchProdi']);
Route::get('/apimhs', [MahasiswaController::class, 'fetchMahasiswa']);
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);
