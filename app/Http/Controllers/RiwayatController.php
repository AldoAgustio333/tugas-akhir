<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua pemesanan milik user login
        $pemesanans = Pemesanan::with('jbi')
            ->where('nama_pemesan', $user->name)
            ->orderBy('tanggal', 'desc') // Ganti ke nama kolom yang kamu pakai, misal 'tanggal'
            ->get();

        return view('riwayat.index', compact('pemesanans'));
    }

    public function show($id)
{
    $pemesanan = \App\Models\Pemesanan::with('jbi')->findOrFail($id);

    return view('riwayat._detail', compact('pemesanan'));
}

public function invoice($id)
{
    $pemesanan = Pemesanan::with(['jbi', 'user'])->findOrFail($id);
    return view('riwayat.invoice', compact('pemesanan'));
}
}
