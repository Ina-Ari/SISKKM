<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Kegiatan;

class MahasiswaController extends Controller
{
    public function fetchMahasiswa(){
        $mahasiswa = Http::post('https://webapi.pnb.ac.id/api/mahasiswa', [
            "TahunAkademik" => 20222,
            "Jurusan" => "",
            "Prodi" => "",
            "HashCode" => "857FA947BC447C037C3CA7796D80395104AF7D165E46EB4398A616362E8D6E30"
            ]
        );
 
        $dataMahasiswa = json_decode($mahasiswa, true)["daftar"];
        $arrayMahasiswa = [];
        $data = Mahasiswa::all();

        for ($i=0; $i < count($data); $i++) {
            $angkatan = $dataMahasiswa[$i]["tahunAkademik"];
            $nim = (int)$dataMahasiswa[$i]["nim"];
            $nama = $dataMahasiswa[$i]["nama"];
            $telepon = $dataMahasiswa[$i]["telepon"];
            $email = $dataMahasiswa[$i]["email"];
            $jenjang = $dataMahasiswa[$i]["jenjang"];
            $kodeProdi = $dataMahasiswa[$i]["kodeProdi"];
            $kodeJurusan = $dataMahasiswa[$i]["kodeJurusan"];

            $prodi = Prodi::where('kode_prodi', $kodeProdi)->first();
            $jurusan = Jurusan::where('kode_jurusan', $kodeJurusan)->first();

            if ($prodi || $jurusan) {
                $exists = Mahasiswa::where('nim', $nim)->first();

                if(!$exists){
                    array_push($arrayMahasiswa,[
                        'nim' => $nim,
                        'nama' => $nama,
                        'angkatan' => $angkatan,
                        'no_telepon' => $telepon,
                        'jenjang_pendidikan' => $jenjang,
                        'kode_prodi' => $kodeProdi,
                        'kode_jurusan' => $kodeJurusan,
                        'email' => $email,
                        'password' => $nim
                    ]);
                }
            } 
        }
        // // dd($arrayMahasiswa[334]);
        if(count($arrayMahasiswa)>0)Mahasiswa::insert($arrayMahasiswa);
        return true;
    }

    public function index(Request $request)
    {
        $jurusan = Jurusan::all();

        // Filter mahasiswa berdasarkan jurusan jika ada parameter 'jurusan'
        $query = Mahasiswa::query();

        if ($request->has('jurusan') && $request->jurusan != 'all') {
            $query->where('kode_jurusan', $request->jurusan);
        }

        // Ambil data mahasiswa (dengan filter jika ada)
        $data = $query->with(['prodi', 'jurusan'])->has('kegiatan')->get();

        $status = [];

        foreach ($data as $mahasiswa) {

            $totalPoin = 0;

            foreach ($mahasiswa->kegiatan as $kegiatan) {
                if ($kegiatan->verif === 'True') {
                    $totalPoin += $kegiatan->Poin->poin;
                }
            }

            $keterangan = $totalPoin >= 28 ? 'Lulus' : 'Belum Lulus';

            $status[$mahasiswa->nim] = $keterangan;
        }

        return view('daftarmahasiswa', compact('data', 'status', 'jurusan'));
    }

    public function kegiatan($id, Request $request)
    {
        $filter = $request->get('filter', 'all');

        // Ambil data mahasiswa beserta kegiatan yang difilter
        $query = Mahasiswa::with(['kegiatan' => function ($q) use ($filter) {
            if ($filter === 'True') {
                $q->where('verif', 'True');
            } elseif ($filter === 'False') {
                $q->where('verif', 'False');
            }
        }])->findOrFail($id);

        return view('kegiatanmahasiswa', compact('query'))->with('filter', $filter);

    }

    
}
