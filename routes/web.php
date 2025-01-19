<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kegiatanController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthMhsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\tingkatKegiatanController;
use App\Http\Controllers\posisiController;
use App\Http\Controllers\poinController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\formControl;
use Illuminate\Routing\Route as RoutingRoute;

// Route::get('/', function () { 
//     return view('master');
// });

// Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('kegiatan/not-verified', [KegiatanController::class, 'notVerified'])->name('kegiatan_not_verified');
Route::post('kegiatan/verify-selected', [KegiatanController::class, 'verifySelected'])->name('kegiatan.verify_selected');
Route::post('kegiatan/cancel-selected', [KegiatanController::class, 'cancelSelected'])->name('kegiatan.cancel_selected');

// Routing Admin
Route::get('/login', [AuthAdminController::class, 'login'])->name('login');
Route::post('/loggedin', [AuthAdminController::class, 'loggedin'])->name('loggedin')->middleware('throttle:5,1');
Route::middleware('auth:admin')->group(function () {
    // Dashboard admin
    Route::get('/indexAdmin', [AuthAdminController::class, 'indexAdmin'])->name('indexAdmin')->middleware('auth');
    Route::get('/daftarkegiatan', [AuthAdminController::class, 'daftarkegiatan'])->name('daftarkegiatan')->middleware('auth');
});
Route::get('/logout', [AuthAdminController::class, 'logout'])->name('logout');

// Routing Mahasiswa
Route::get('/loginmhs', [AuthMhsController::class, 'loginmhs'])->name('loginmhs');
Route::post('/loggedinmhs', [AuthMhsController::class, 'loggedinmhs'])->name('loggedinmhs')->middleware('throttle:5,1');
Route::get('/indexMahasiswa', [AuthMhsController::class, 'indexMhs'])->name('indexMhs');
Route::get('/profilMhs', [AuthMhsController::class, 'profilMhs'])->name('profilMhs');
Route::get('/emailSubmit', [AuthMhsController::class, 'emailSubmit'])->name('emailSubmit');
Route::post('/sendEmail',[MailController::class, 'sendEmail'])->name('sendMail');
Route::get('/emailConf', [AuthMhsController::class, 'emailConf'])->name('emailConf');
Route::get('/changepassword', [AuthMhsController::class, 'changepassword'])->name('changepassword');
Route::post('/updatepassword', [AuthMhsController::class, 'updatePassword'])->name('updatePassword');
Route::get('/logoutmhs', [AuthMhsController::class, 'logoutmhs'])->name('logoutmhs');
Route::get('/updateKegiatan', [AuthMhsController::class, 'updateKegiatan'])->name('updateKegiatan');




//Routing Pages
Route::get('/', [dashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/apijurusan', [JurusanController::class, 'fetchJurusan']);
Route::get('/apiprodi', [ProdiController::class, 'fetchProdi']);
Route::get('/apimhs', [MahasiswaController::class, 'fetchMahasiswa']);
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);

//routing kegiatan
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);
Route::resource('form', formControl::class);
Route::get('/dashboardMhs', [formControl::class,'indexMahasiswa'])->name('dashboardMhs');
Route::get('/form', function () {
    return view('form');
});
Route::post('/tambahKegiatan', [formControl::class, 'store'])->name('form.store');
Route::post('/updateKegiatan/{id_kegiatan}', [formControl::class, 'updateKegiatan'])->name('form.updateKegiatan');
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/{id}/kegiatan', [MahasiswaController::class, 'kegiatan'])->name('mahasiswa.kegiatan');
Route::get('/mahasiswa/{nim}/edit', [formControl::class, 'edit'])->name('form.edit');
Route::post('/mahasiswa/{nim}/update', [formControl::class, 'update'])->name('form.update');

?>

