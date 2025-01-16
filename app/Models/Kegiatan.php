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
        'id_poin',
        'id_posisi',
        'idtingkat_kegiatan',
        'idjenis_kegiatan',
        'sertifikat',
        'verifsertif',
        'verif'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    public function tingkatKegiatan()
    {
        return $this->belongsTo(TingkatKegiatan::class, 'idtingkat_kegiatan');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'idjenis_kegiatan');
    }

    public function poin()
    {
        return $this->belongsTo(Poin::class, 'id_poin');
    }
}
