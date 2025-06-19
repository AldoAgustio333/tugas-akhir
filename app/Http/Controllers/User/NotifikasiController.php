<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        // contoh data dummy notifikasi
        $notifikasi = [
            ['judul' => 'Pemesanan Berhasil', 'pesan' => 'Pesanan JBI Anda telah dikonfirmasi.', 'tanggal' => '2025-05-17'],
            ['judul' => 'Promo Baru!', 'pesan' => 'Dapatkan diskon 20% untuk pemesanan bulan ini.', 'tanggal' => '2025-05-15'],
        ];

        return view('user.notifikasi.index', compact('notifikasi'));
    }
}
