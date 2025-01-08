<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function fetchJurusan(){
        $jurusan = Http::post('https://webapi.pnb.ac.id/api/daftarjurusan', [
            "HashCode" => "65020385BE01144F4187C2EB100D851C09CFD40F774BD629896E739C1D5EE156"
            // hashcode mhasiswa = 857FA947BC447C037C3CA7796D80395104AF7D165E46EB4398A616362E8D6E30
            ]
        );
        $dataJurusan = json_decode($jurusan, true)["daftar"];
        $arrayJurusan = [];

        for ($i=0; $i < count($dataJurusan); $i++) {
            $kodeJurusan = (int)$dataJurusan[$i]["kodeJurusan"];
            $namaJurusan = $dataJurusan[$i]["namaJurusan"];
            $exists = Jurusan::where('nama_jurusan', $namaJurusan)->first();

            if(!$exists){
                array_push($arrayJurusan,[
                    'kode_jurusan' => $kodeJurusan,
                    'nama_jurusan' => $namaJurusan
                ]);
            }
        }

        if(count($arrayJurusan)>0)Jurusan::insert($arrayJurusan);
        return true;
    }
}
