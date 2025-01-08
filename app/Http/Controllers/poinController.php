<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;

class poinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Poin::with(['posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->get();
        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        // dd($data);
        return view('poin', compact('data', 'posisi', 'tingkatKegiatan', 'jenisKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idjenis_kegiatan'  => 'required',
            'idtingkat_kegiatan'=> 'required',
            'id_posisi'         => 'required',
            'poin'              => 'required|integer',
        ]);

        Poin::create($request->all());

        return redirect()->back()->with('success', 'Data poin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'idjenis_kegiatan'  => 'required',
            'idtingkat_kegiatan'=> 'required',
            'id_posisi'         => 'required',
            'poin'              => 'required|integer',
        ]);

        $poin = Poin::findOrFail($id);

        $poin->update($request->all());

        return redirect()->back()->with('success', 'Data poin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poin = Poin::find($id);

        if ($poin) {
            // Menghapus data
            $poin->delete();
            return redirect()->route('poin.index')->with('success', 'poin berhasil dihapus.');
        } else {
            return redirect()->route('poin.index')->with('error', 'Data tidak ditemukan.');
        }
    }
}
