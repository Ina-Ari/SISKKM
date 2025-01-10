<?php

namespace App\Http\Controllers;

use App\Mail\confirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validasi email dan pastikan ada di database
        $request->validate([
            'email' => 'required|email|exists:mahasiswa,email', // Tabel mahasiswas
        ]);
    
        // Ambil email dari request
        $to = $request->email;
    
        // Buat token unik untuk reset password
        $token = Str::random(64);
    
        // Simpan token ke tabel `password_resets`
        DB::table('password_reset_tokens')->insert([
            'email' => $to,
            'token' => $token,
            'created_at' => now(),
        ]);
    
        // Pesan email
        $msg = "Ini adalah email konfirmasi untuk perubahan password Anda. Silakan klik tautan berikut untuk melanjutkan proses: ";
        $msg .= url('/changepassword') . '?token=' . $token . '&email=' . urlencode($to);
        $subject = "Konfirmasi Perubahan Password";
    
        // Kirim email
        Mail::to($to)->send(new ConfirmationMail($msg, $subject));
    
        // Beri feedback ke user
        // return back()->with('success', 'Email berhasil dikirim. Silakan cek email Anda.');
        return redirect()->route('emailConf');

    }
    

    // public function sendEmail(Request $request)
    // {
    //     // Validasi email
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);
        
    //     // Data email yang akan dikirim
    //     $to = $request->email;
    //     $msg = "Ini adalah email konfirmasi untuk perubahan password Anda. Silakan klik tautan berikut untuk melanjutkan proses: [tautan].";
    //     $subject = "Konfirmasi Perubahan Password";
        
    //     // Kirim email
    //     Mail::to($to)->send(new ConfirmationMail($msg, $subject));
        
    //     // Beri feedback ke user
    //     return back()->with('success', 'Email berhasil dikirim. Silakan cek email Anda.');
    // }
}


// class MailController extends Controller
// { 
//     function sendEmail(){
//         $to="rahmakhoirani87@gmail.com";
//         $msg="dummy text";
//         $subject="Konfirmasi Perubahan Password";
//         Mail::to($to)->send(new confirmationMail($msg,$subject));
//         return "send Email";
//     }
// }