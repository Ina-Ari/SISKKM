<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthMhsController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\MailController;
use App\Models\AuthMhs;
use Illuminate\Routing\Route as RoutingRoute;

// Route::get('/', function () {
//     return view('master');
// });

// Routing Admin
Route::get('/login', [AuthAdminController::class, 'login'])->name('login');
Route::post('/loggedin', [AuthAdminController::class, 'loggedin'])->name('loggedin')->middleware('throttle:5,1');
Route::middleware('auth:admin')->group(function () {
    // Dashboard admin
    Route::get('/indexAdmin', [AuthAdminController::class, 'indexAdmin'])->name('indexAdmin');
    Route::get('/daftarkegiatan', [AuthAdminController::class, 'daftarkegiatan'])->name('daftarkegiatan');
});
Route::get('/logout', [AuthAdminController::class, 'logout'])->name('logout');


// Routing Mahasiswa
Route::get('/loginmhs', [AuthMhsController::class, 'loginmhs'])->name('loginmhs');
Route::post('/loggedinmhs', [AuthMhsController::class, 'loggedinmhs'])->name('loggedinmhs')->middleware('throttle:5,1');
Route::get('/indexMahasiswa', [AuthMhsController::class, 'indexMhs'])->name('indexMhs');
Route::get('/emailSubmit', [AuthMhsController::class, 'emailSubmit'])->name('emailSubmit');
Route::post('/sendEmail',[MailController::class, 'sendEmail'])->name('sendMail');
Route::get('/emailConf', [AuthMhsController::class, 'emailConf'])->name('emailConf');
Route::get('/changepassword/{email}/{token}', [AuthMhsController::class, 'changepassword'])->name('changepassword');
// Route::get('/changepassword/{token}', [AuthMhsController::class, 'changepassword'])->name('changepassword');
// Route::get('/changepassword', [AuthMhsController::class, 'changepassword'])->name('changepassword');
Route::post('/updatepassword', [AuthMhsController::class, 'updatePassword'])->name('updatePassword');
Route::get('/logout', [AuthMhsController::class, 'logout'])->name('logout');


//Routing Pages
Route::resource('jenisKegiatan', jenisKegiatanController::class);

// Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
// Route::get('/jenisKegiatan', [jenisKegiatanController::class, 'index'])->name('jenisKegiatan');


