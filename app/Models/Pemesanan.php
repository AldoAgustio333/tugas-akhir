<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // nama tabel (pastikan sama dengan di DB)

    protected $fillable = [
        'jbi_id',
        'nama_pemesan',
        'email',
        'no_hp',
        'tanggal',
        'deskripsi',
        'jam_awal',
        'jam_akhir',
        'durasi_jam',
        'biaya',
        'status',
    ];

    // Relasi ke model Jbi (many-to-one)
    public function jbi()
    {
        return $this->belongsTo(Jbi::class, 'jbi_id');
    }

    public function user()
    {
        
        return $this->belongsTo(User::class, 'nama_pemesan', 'name', 'user_id', 'status'); // jika `nama_pemesan` = name dari user
    }

    public function testimoni()
{
    return $this->hasOne(Testimoni::class);
}

}
