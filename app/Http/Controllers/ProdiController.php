<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Jurusan;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function fetchProdi(){
        $prodi = Http::post('https://webapi.pnb.ac.id/api/daftarprogramstudi', [
            "kodeJur" => "",
            "HashCode" => "65020385BE01144F4187C2EB100D851C09CFD40F774BD629896E739C1D5EE156"
            // hashcode mhasiswa = 857FA947BC447C037C3CA7796D80395104AF7D165E46EB4398A616362E8D6E30
            ]
        ); 
        $dataProdi = json_decode($prodi, true)["daftar"];
        $arrayProdi = [];

        for ($i=0; $i < count($dataProdi); $i++) {
            $kodeProdi = (int)$dataProdi[$i]["kodeProdi"];
            $namaProdi = $dataProdi[$i]["namaProdi"];
            $namaJurusan = $dataProdi[$i]["jurusan"];

            $jurusan = Jurusan::where('nama_jurusan', $namaJurusan)->first();

            if($jurusan){
                $exists = Prodi::where('nama_prodi', $namaProdi)->first();

                if(!$exists){
                    array_push($arrayProdi,[
                        'kode_Prodi' => $kodeProdi,
                        'nama_Prodi' => $namaProdi,
                        'kode_jurusan' => $jurusan->kode_jurusan
                    ]);
                }
            }
        }
        if(count($arrayProdi)>0)Prodi::insert($arrayProdi);
        return true;
    }
}
