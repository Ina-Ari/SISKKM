<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class kegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('verif', 'true')->get(); // Data kegiatan terverifikasi
        return view('kegiatan', compact('kegiatan'));
    }

    public function notVerified()
    {
        $kegiatan = Kegiatan::where('verif', '!=', 'true')->get();
        return view('kegiatan_not_verified', compact('kegiatan'));
    }

    public function verifySelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'true']);

        return redirect()->route('kegiatan_not_verified')->with('success', 'Kegiatan yang dipilih berhasil diverifikasi.');
    }

    public function cancelSelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'false']);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dibatalkan.');
    }
}
