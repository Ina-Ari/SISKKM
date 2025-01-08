<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posisi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_posisi';
    protected $table = 'posisi';
    public $timestamps = false;
    protected $fillable = [
        'nama_posisi',
    ];

    public function poin()
    {
        return $this->hasMany(Poin::class, 'id_poin');
    }
}
