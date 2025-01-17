<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthMhs extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'mahasiswa';
    public $timestamps = false; // Nonaktifkan timestamps

    /**
     * Primary key untuk tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'nim';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'angkatan',
        'no_telepon',
        'jenjang_pendidikan',
        'kode_prodi',
        'kode_jurusan',
        'alamat',
        'email',
        'password',
    ];
 
    /**
     * Kolom yang harus disembunyikan dalam serialisasi.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut kolom.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'angkatan' => 'integer',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel Prodi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi');
    }

    /**
     * Relasi ke tabel Jurusan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan');
    }
}
