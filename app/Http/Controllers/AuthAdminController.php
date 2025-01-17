<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;

class AuthAdminController extends Controller 
{
    function login()
    {
        return view('login');
    }

    function indexAdmin()
    {
        return view('indexAdmin');
    } 

    function daftarKegiatan()
    {
        return view('daftarkegiatan');
    } 

    function loggedin(Request $request)
    {
        // Menyusun key unik untuk membatasi percobaan login berdasarkan email dan IP
        $key = Str::lower($request->input('username')) . '|' . $request->ip();

        // Mengecek jika terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {  // Batasi 5 percobaan dalam 1 menit
            $remainingTime = RateLimiter::availableIn($key);  // Waktu tunggu sebelum dapat mencoba login lagi
            return redirect()->back()->with('gagal', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $remainingTime . ' detik.');
        }

        // Cek kredensial dengan guard 'admin'
        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            // Jika login berhasil, reset rate limiter dan buat session baru
            RateLimiter::clear($key);  // Reset percobaan login

            // Hitung total kegiatan yang diajukan oleh mahasiswa
            $totalMhs = DB::table('mahasiswa')->count();

            $totalVerifTrue = DB::table('kegiatan')
            ->where('verif', 'true')
            ->count();

            $totalVerifFalse = DB::table('kegiatan')
            ->where('verif', 'false')
            ->count();        

            $request->session()->regenerate();  // Regenerasi session untuk mencegah session fixation
            $request->session()->put('totalMhs', $totalMhs);
            $request->session()->put('totalVerifTrue', $totalVerifTrue);
            $request->session()->put('totalVerifFalse', $totalVerifFalse);  
            return redirect()->route('indexAdmin');
        } else {
            // Jika login gagal, tambahkan percobaan login
            RateLimiter::hit($key, 60);  // Tambah percobaan, reset setelah 60 detik
            return redirect()->back()->with('gagal', 'Username atau password anda salah');
        }
    }

    public function logout(Request $request)
    {
        // Log out the authenticated user
        Auth::guard('admin')->logout();
    
        // Invalidate the session
        $request->session()->invalidate();
    
        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();
    
        // Redirect to the login page
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
