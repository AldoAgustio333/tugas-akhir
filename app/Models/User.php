<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Tambahkan ini jika ingin mendefinisikan nama tabel secara eksplisit
    protected $table = 'users';
    protected $fillable = [
    'name',
    'email',
    'password',
    'jk',
    'no_hp',
    'status',
    'npm',
    'fakultas',
    'program_studi',
    'kelas',
    'foto',
    'role',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pemesanans()
{
    return $this->hasMany(Pemesanan::class, 'nama_pemesan', 'name'); // atau 'user_id' jika sudah pakai foreign key
}
}
