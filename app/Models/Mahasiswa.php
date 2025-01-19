<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'nim'; 
    protected $table = 'mahasiswa';
    public $timestamps = false;
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'angkatan',
        'no_telepon',
        'jenjang_pendidikan',
        'kode_prodi',
        'kode_jurusan',
        'alamat',
        'email',
        'password',
        'foto_profil'
    ];
 
 
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'nim');
    }
}
