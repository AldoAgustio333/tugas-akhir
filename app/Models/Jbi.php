<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jbi extends Model
{
    use HasFactory;

    protected $table = 'jbis';

    protected $fillable = [
        'nama', 'keahlian', 'jk', 'no_hp', 'ketersediaan', 'jadwal', 'alamat', 'layanan', 'status', 'jam', 'jam_selesai', 'foto',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'jbi_id');
    }
}
