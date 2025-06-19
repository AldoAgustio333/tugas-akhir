<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $fillable = ['user_id', 'jbi_id', 'pemesanan_id', 'review'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jbi() {
        return $this->belongsTo(Jbi::class);
    }

    public function pemesanan() {
        return $this->belongsTo(Pemesanan::class);
    }
}
