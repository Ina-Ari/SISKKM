<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kegiatanController;


// Route::get('/', function () {
//     return view('master');
// });

Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
// Route::get('/jenisKegiatan', [jenisKegiatanController::class, 'index'])->name('jenisKegiatan');

Route::resource('jenisKegiatan', jenisKegiatanController::class);

Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('kegiatan/not-verified', [KegiatanController::class, 'notVerified'])->name('kegiatan_not_verified');
Route::post('kegiatan/verify-selected', [KegiatanController::class, 'verifySelected'])->name('kegiatan.verify_selected');
Route::post('kegiatan/cancel-selected', [KegiatanController::class, 'cancelSelected'])->name('kegiatan.cancel_selected');
?>
