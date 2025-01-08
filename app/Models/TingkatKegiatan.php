<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKegiatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'idtingkat_kegiatan';
    protected $table = 'tingkat_kegiatan';
    public $timestamps = false;
    protected $fillable = [
        'tingkat_kegiatan',
    ];

    public function poin()
    {
        return $this->hasMany(Poin::class, 'idtingkat_kegiatan');
    }
}
