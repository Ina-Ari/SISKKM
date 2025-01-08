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
<<<<<<< HEAD
    ];
=======
    ];  

    public function poin()
    {
        return $this->hasMany(Poin::class, 'idjenis_kegiatan');
    }

>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
}
