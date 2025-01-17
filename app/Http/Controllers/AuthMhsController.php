<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\JenisKegiatan;
use App\Models\kegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;
use App\Models\AuthMhs;
use App\Models\Mahasiswa;

class AuthMhsController extends Controller
{
    function loginmhs()
    {
        return view('loginmhs');
    }

    function profilMhs()
    {   
        return view('mhs.profileMhs');
    } 

    public function indexMhs()
    {
        if (!session()->has('nama')) {
            return redirect()->route('loginmhs');
        }

        // $nim = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $nim = session('nim');

        $kegiatan = DB::table('kegiatan')
            ->join('tingkat_kegiatan', 'kegiatan.idtingkat_kegiatan', '=', 'tingkat_kegiatan.idtingkat_kegiatan')
            ->join('posisi', 'kegiatan.id_posisi', '=', 'posisi.id_posisi')
            ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin')
            ->where('kegiatan.nim', $nim)
            ->select('kegiatan.*', 'tingkat_kegiatan.tingkat_kegiatan', 'posisi.nama_posisi', 'poin.poin')
            ->get();

        //dd(session()->all());
        // dd($nim);

        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();

        return view('mhs.dashboardMhs', compact('kegiatan', 'posisi', 'tingkatKegiatan', 'jenisKegiatan', 'nim'));
    }


    public function indexMahasiswa()
    {
        // $mahasiswa = session()->has('nim');
        $data = Poin::with(['posisi', 'tingkatKegiatan', 'jenisKegiatan'])->get();
        $posisi = Posisi::all(); // Data untuk dropdown posisi
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        // $kegiatan = Kegiatan::where('nim',$mahasiswa)->get();

        // dd($posisi);
        // dd($mahasiswa);

        return view('mhs.dashboardMhs', compact('data', 'posisi', 'tingkatKegiatan', 'jenisKegiatan'));
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

            $kegiatan = DB::table('kegiatan')
            ->join('tingkat_kegiatan', 'kegiatan.idtingkat_kegiatan', '=', 'tingkat_kegiatan.idtingkat_kegiatan')
            ->join('posisi', 'kegiatan.id_posisi', '=', 'posisi.id_posisi')
            ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin')
            ->where('kegiatan.nim', $user->nim)
            ->select('kegiatan.*', 'tingkat_kegiatan.tingkat_kegiatan', 'posisi.nama_posisi', 'poin.poin')
            ->get();
        
            // Kalkulasi total poin untuk kegiatan yang terverifikasi
            $totalPoin = $kegiatan->filter(function ($item) {
                return $item->verif === 'true'; // Atau gunakan true jika tipe data adalah boolean
            })->sum('poin');

            // Ambil data mahasiswa dari model berdasarkan nim
            $mahasiswa = AuthMhs::where('nim', $user->nim)->first();

            // Simpan data kegiatan ke session
            $request->session()->put('kegiatan', $kegiatan);


            // Hitung total kegiatan terverifikasi yang diajukan oleh mahasiswa
            $totalVerifTrue = DB::table('kegiatan')
                ->where('verif', 'true')
                ->where('nim', $user->nim) // Perbaiki query: tambahkan kondisi 'nim' sebagai filter
                ->count();

            $totalVerifFalse = DB::table('kegiatan')
                ->where('verif', 'false')
                ->where('nim', $user->nim) // Perbaiki query: tambahkan kondisi 'nim' sebagai filter
                ->count();

            // Hitung total kegiatan yang diajukan oleh mahasiswa
            $totalKegiatan = DB::table('kegiatan')
                ->where('nim', $user->nim)
                ->count();

            // Simpan value yang diperlukan untuk session mahasiswa

            $request->session()->regenerate(); // Regenerasi sesi
            session(['totalPoin' => $totalPoin]);
            $minimalPoin = 28;
            $progress = min(100, ($totalPoin / $minimalPoin) * 100);
            $request->session()->put([
                'nim' => $user->nim,
                'nama' => $user->nama,
                'email' => $user->email,
                'no_telepon' => $user->no_telepon,
                'jenjang_pendidikan' => $user->jenjang_pendidikan,
                'angkatan' => $user->angkatan,
                'totalVerifTrue' => $totalVerifTrue,
                'totalVerifFalse' => $totalVerifFalse,
                'totalKegiatan' => $totalKegiatan,
            ]);

            // Pastikan nim diset setelah regenerasi session

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
