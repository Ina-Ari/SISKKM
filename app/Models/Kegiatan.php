<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan'; // Nama tabel kegiatan
    //tambah
    protected $primaryKey = 'id_kegiatan'; // Menentukan kolom primary key

    // Nonaktifkan timestamps
    public $timestamps = false; // Tambahkan ini

    protected $fillable = [
        'nim',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'sertifikat',
        'verifsertif',
        'verif'
    ];
}
