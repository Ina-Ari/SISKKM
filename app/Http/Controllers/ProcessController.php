<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class ProcessController extends Controller
{
    /**
     * Handle the verification of the uploaded certificate.
     */
    public function verifyCertificate($logoPath, $certPath)
    {
        // Path ke skrip JavaScript
        $jsScriptPath = base_path('resources/skrip/detectLogo.js');

        // Jalankan proses Node.js untuk verifikasi
        $process = new Process(['node', $jsScriptPath, $logoPath, $certPath]);
        $process->run();

        // Periksa apakah proses berhasil dijalankan
        if (!$process->isSuccessful()) {
            throw new \Exception("Gagal menjalankan proses verifikasi.");
        }

        // Ambil output dari proses
        $output = $process->getOutput();

        // Tentukan hasil berdasarkan output
        if (strpos($output, 'Sertifikat Terverifikasi') !== false) {
            return true; // Terverifikasi
        }

        return false; // Tidak terverifikasi
    }
}
