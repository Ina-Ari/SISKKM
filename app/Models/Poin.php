<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;
    protected $primaryKey = 'idpoin';
    protected $table = 'poin';
    public $timestamps = false;
    protected $fillable = [
        'id_posisi',
        'idtingkat_kegiatan',
        'idjenis_kegiatan',
        'poin'
    ];

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

}
