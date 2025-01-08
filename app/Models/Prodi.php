<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_prodi';
    protected $table = 'prodi';
    public $timestamps = false;
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'kode_jurusan'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'kode_jurusan');
    }
}
