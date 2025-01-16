<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kegiatanController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthMhsController;
use App\Http\Controllers\MailController;
use App\Models\AuthMhs;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\tingkatKegiatanController;
use App\Http\Controllers\posisiController;
use App\Http\Controllers\poinController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\jenisKegiatanController;



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
Route::get('/logoutmhs', [AuthMhsController::class, 'logoutmhs'])->name('logoutmhs');


//Routing Pages
Route::resource('jenisKegiatan', jenisKegiatanController::class);

// Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
// Route::get('/jenisKegiatan', [jenisKegiatanController::class, 'index'])->name('jenisKegiatan');

Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
Route::get('/apijurusan', [JurusanController::class, 'fetchJurusan']);
Route::get('/apiprodi', [ProdiController::class, 'fetchProdi']);
Route::get('/apimhs', [MahasiswaController::class, 'fetchMahasiswa']);
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);
?>

