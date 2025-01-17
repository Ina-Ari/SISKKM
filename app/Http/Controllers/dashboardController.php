<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kegiatan;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $jumlahKegiatan = Kegiatan::count();
        $terverifikasi = Kegiatan::where('verif', 'true')->count();
        $belumterverifikasi = Kegiatan::where('verif', 'false')->count();
        $jumlahMahasiswa = Mahasiswa::has('kegiatan')->count();

        return view('dashboard', compact('jumlahKegiatan','terverifikasi','belumterverifikasi','jumlahMahasiswa'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
