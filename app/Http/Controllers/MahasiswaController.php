<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;

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

        for ($i=0; $i < 500; $i++) {
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
        // dd($arrayMahasiswa[334]);
        if(count($arrayMahasiswa)>0)Mahasiswa::insert($arrayMahasiswa);
        return true;
    }
}
