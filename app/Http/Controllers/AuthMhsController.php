<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use App\Models\kegiatan;
use App\Models\Posisi;
use App\Models\Poin;
use App\Models\AuthMhs;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Prodi;

class AuthMhsController extends Controller
{
    function loginmhs()
    {
        return view('loginmhs');
    }

    function profilMhs()
    {   
        if (!session()->has('nama')) {
            return redirect()->route('loginmhs');
        }
    
        // Ambil data mahasiswa berdasarkan nim dari sesi
        $nim = session('nim');
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        $kode_prodi = Prodi::all();
        $jurusan = Jurusan::all();
    
    
        if (!$mahasiswa) {
            // Jika data mahasiswa tidak ditemukan, redirect ke halaman login
            return redirect()->route('loginmhs')->withErrors(['error' => 'Mahasiswa tidak ditemukan.']);
        }
        
        return view('mhs.profileMhs', compact('mahasiswa', 'nim', 'kode_prodi', 'jurusan'));
    } 

    public function indexMhs()
    {
        if (!session()->has('nama')) {
            return redirect()->route('loginmhs');
        }
    
        $nim = session('nim');
    
        // Ambil data mahasiswa berdasarkan nim dari sesi
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
    
        if (!$mahasiswa) {
            // Jika data mahasiswa tidak ditemukan, redirect ke halaman login
            return redirect()->route('loginmhs')->withErrors(['error' => 'Mahasiswa tidak ditemukan.']);
        }

        // $nim = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $kegiatan = DB::table('kegiatan')
            ->join('tingkat_kegiatan', 'kegiatan.idtingkat_kegiatan', '=', 'tingkat_kegiatan.idtingkat_kegiatan')
            ->join('posisi', 'kegiatan.id_posisi', '=', 'posisi.id_posisi')
            ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin') 
            ->where('kegiatan.nim', $nim)
            ->select('kegiatan.*', 'tingkat_kegiatan.tingkat_kegiatan', 'posisi.nama_posisi', 'poin.poin')
            ->get();

        // Kalkulasi total poin untuk kegiatan yang terverifikasi
        $totalPoin = $kegiatan->filter(function ($item) {
            return $item->verif === 'True'; // Or use true if the data type is boolean
        })->sum('poin');

        // Hitung total kegiatan terverifikasi yang diajukan oleh mahasiswa
        $totalVerifTrue = $kegiatan->filter(function ($item) {
            return $item->verif === 'True'; // Or use true if the data type is boolean
        })->count();

        // Hitung total kegiatan yang diajukan oleh mahasiswa
        $totalKegiatan = $kegiatan->count();

        // Kalkulasi total kegiatan yang belum terverifikasi
        $totalVerifFalse = $kegiatan->filter(function ($item) {
            return $item->verif === 'False' || $item->verif == 0; // Memeriksa 'False' atau 0
        })->count();
        

        $jenjang_pendidikan = $mahasiswa->jenjang_pendidikan;

        //dd(session()->all());
        // dd($nim);

        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();

        return view('mhs.dashboardMhs', compact('kegiatan', 'posisi', 'tingkatKegiatan', 'jenisKegiatan', 'nim', 'mahasiswa', 
                                                'totalPoin', 'totalVerifTrue', 'totalKegiatan', 'totalVerifFalse', 'jenjang_pendidikan'));
    }


    function confirmationMail()
    {
        return view('confirmationMail');
    }

    public function changepassword(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        return view('changepassword', ['token' => $token, 'email' => $email]);
    }

    function emailSubmit()
    {
        return view('emailSubmit');
    } 

    function emailConf()
    {  
        return view('emailConf');
    }

    function loggedinmhs(Request $request)
    {
        // Buat key unik untuk pembatasan login
        $key = Str::lower($request->input('nim')) . '|' . $request->ip();

        // Cek apakah ada terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $remainingTime = RateLimiter::availableIn($key);
            return redirect()->back()->with('gagal', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $remainingTime . ' detik.');
        }

        // Ambil pengguna dari tabel mahasiswa menggunakan model AuthMhs
        $user = \App\Models\AuthMhs::where('nim', $request->input('nim'))->first();

        // Periksa apakah pengguna ada dan password cocok
        if ($user && ($user->password === $request->input('password') || Hash::check($request->input('password'), $user->password))) {
            // Jika password masih plaintext, hash dan simpan
            if ($user->password === $request->input('password')) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
            }

            // Login pengguna 
            Auth::login($user);
            RateLimiter::clear($key); // Reset percobaan login

            // Ambil data mahasiswa dari model berdasarkan nim
            $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();
            
            // Regenerasi sesi
            $request->session()->regenerate(); 

            // Simpan value yang diperlukan untuk session mahasiswa
            $request->session()->put([
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
            ]);

            // Redirect ke halaman mahasiswa
            return redirect()->route('indexMhs');

        } else {
            // Jika login gagal, tambahkan hit ke RateLimiter
            RateLimiter::hit($key, 60); // Tambah percobaan, reset setelah 60 detik
            return redirect()->back()->with('gagal', 'NIM atau password anda salah');
        }
    }


    // Logout method for 'mahasiswa'
    public function logoutMhs(Request $request)
    {
        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect()->route('loginmhs')->with('success', 'You have been logged out successfully.');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'token' => 'required|exists:password_reset_tokens,token',
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'token.required' => 'Token reset password diperlukan.',
            'token.exists' => 'Token reset password tidak valid.',
        ]);
        

        // Temukan token reset password
        $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Token reset tidak valid atau telah kadaluarsa.']);
        }

        // Temukan mahasiswa berdasarkan email yang ada pada token reset
        $mahasiswa = AuthMhs::where('email', $reset->email)->first();

        if (!$mahasiswa) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Perbarui password
        $mahasiswa->password = Hash::make($request->password);
        $mahasiswa->save();

        // Hapus token reset
        DB::table('password_reset_tokens')->where('email', $mahasiswa->email)->delete();

        return redirect()->route('loginmhs')->with('success', 'Password berhasil diubah. Silakan login.');
    }
}
