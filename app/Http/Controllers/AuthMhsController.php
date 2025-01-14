<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\AuthMhs;

class AuthMhsController extends Controller
{
    function loginmhs()
    {
        return view('loginmhs');
    } 

    // function indexMhs()
    // {   
    //     return view('mhs.dashboardMhs');
    // } 

    public function indexMhs()
    {
        // dd(session()->all());
        if (!session()->has('nama')) {
            return redirect()->route('loginmhs');
        }
    
        return view('mhs.dashboardMhs');
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

            // Ambil data kegiatan milik mahasiswa dari tabel kegiatan, Join dengan tabel terkait
            $kegiatan = DB::table('kegiatan')
            ->join('tingkat_kegiatan', 'kegiatan.idtingkat_kegiatan', '=', 'tingkat_kegiatan.idtingkat_kegiatan')
            ->join('posisi', 'kegiatan.id_posisi', '=', 'posisi.id_posisi') // Tambahkan join ke tabel posisi
            ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin') // Tambahkan join ke tabel poin
            ->where('kegiatan.nim', $user->nim)
            ->select('kegiatan.*', 'tingkat_kegiatan.tingkat_kegiatan', 'posisi.nama_posisi', 'poin.poin') // Pilih kolom tambahan dari posisi
            ->get();

            // Simpan data kegiatan ke session
            $request->session()->put('kegiatan', $kegiatan);
                 
            // Hitung total kegiatan terverifikasi yang diajukan oleh mahasiswa
            $totalVerifTrue = DB::table('kegiatan')
            ->where('verifsertif', 'true')
            ->where('nim', $user->nim) // Perbaiki query: tambahkan kondisi 'nim' sebagai filter
            ->count();
        
            $totalVerifFalse = DB::table('kegiatan')
            ->where('verifsertif', 'false')
            ->where('nim', $user->nim) // Perbaiki query: tambahkan kondisi 'nim' sebagai filter
            ->count();

            // Hitung total kegiatan yang diajukan oleh mahasiswa
            $totalKegiatan = DB::table('kegiatan')
            ->where('nim', $user->nim)
            ->count();
            
            // Simpan value yang diperlukan untuk session mahasiswa
            $request->session()->regenerate(); // Regenerasi sesi
            $request->session()->put('nama', $user->nama); 
            $request->session()->put('totalVerifTrue', $totalVerifTrue);
            $request->session()->put('totalVerifFalse', $totalVerifFalse);  
            $request->session()->put('totalKegiatan', $totalKegiatan);
            
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
            'token' => 'required|exists:password_reset_tokens,token', // Verifikasi token yang valid
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
    
    

    // Update Password
    // public function updatePassword(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email', // Pastikan email ada di database
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:8|confirmed', // Pastikan password baru minimal 8 karakter
    //     ]);

    //     // Ambil pengguna berdasarkan email
    //     $user = User::where('email', $request->email)->first();

    //     // Periksa apakah password lama sesuai
    //     if (!Hash::check($request->old_password, $user->password)) {
    //         return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
    //     }

    //     // Update password baru
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     // Berikan respons sukses
    //     return redirect()->route('loginmhs')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    // }
}