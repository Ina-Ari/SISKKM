<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabel yang digunakan oleh model ini
    protected $table = 'admin';

    // Primary key untuk tabel ini 
    protected $primaryKey = 'id_admin';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'username',
        'password',
    ];

    // Kolom yang harus disembunyikan dalam serialisasi
    protected $hidden = [
        'password',
    ];

    // Casting atribut
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}


?>
