<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'idjenis_kegiatan';
    protected $table = 'jenis_kegiatan';
    public $timestamps = false;
    protected $fillable = [
        'jenis_kegiatan',
    ];

    public function poin()
    {
        return $this->hasMany(Poin::class, 'idjenis_kegiatan');
    }
}
