<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings'; // sesuaikan dengan nama tabel kamu

    protected $fillable = [
        'user_id',
        'jbi_id',
        'tanggal_booking',
        'status',
        'total_biaya',
        'metode_pembayaran',
        'keterangan',
        // tambahkan kolom lain sesuai tabel
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke JBI (misalnya jenis booking item)
    public function jbi()
    {
        return $this->belongsTo(Jbi::class, 'jbi_id');
    }
}
