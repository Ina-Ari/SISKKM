<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_jurusan';
    protected $table = 'jurusan';
    public $timestamps = false;
    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan'
    ];


    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'kode_jurusan');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kode_jurusan');
    }
}
