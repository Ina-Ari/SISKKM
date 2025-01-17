<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;

class kegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with(['poin', 'posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->where('verif', 'true')->get();
        return view('kegiatan', compact('kegiatan'));
    }

    public function notVerified()
    {
        $kegiatan = Kegiatan::with(['poin', 'posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->where('verif', '!=', 'true')->get();
        return view('kegiatan_not_verified', compact('kegiatan'));
    }

    public function verifySelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'True']);

        return redirect()->route('kegiatan_not_verified')->with('success', 'Kegiatan berhasil diverifikasi.');
    }

    public function cancelSelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'False']);

        return redirect()->route('kegiatan.index')->with('success', 'Verfikasi kegiatan berhasil dibatalkan.');
    }
}
