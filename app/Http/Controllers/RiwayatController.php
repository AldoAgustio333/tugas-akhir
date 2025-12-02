<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil email user yang sedang login
        $userEmail = auth()->user()->email;
        
        // Tampilkan pemesanan dengan status 'disetujui' atau 'completed' untuk user yang login
        $pemesanansCompleted = Pemesanan::whereIn('status', ['disetujui', 'completed'])
                              ->where('email', $userEmail)
                              ->with(['jbi'])
                              ->orderBy('created_at', 'desc')
                              ->get();

        // Tampilkan pemesanan yang belum selesai untuk user yang login
        $pemesanansIncomplete = Pemesanan::whereNotIn('status', ['disetujui', 'completed'])
                              ->where('email', $userEmail)
                              ->with(['jbi'])
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('riwayat.index', compact('pemesanansCompleted', 'pemesanansIncomplete'));
    }

    public function show($id)
    {
        $userEmail = auth()->user()->email;
        $pemesanan = \App\Models\Pemesanan::with('jbi')
                    ->where('email', $userEmail)
                    ->findOrFail($id);

        return view('riwayat.detail', compact('pemesanan'));
    }

    public function invoice($id)
    {
        $userEmail = auth()->user()->email;
        $pemesanan = Pemesanan::with(['jbi', 'user'])
                    ->where('email', $userEmail)
                    ->findOrFail($id);
        return view('riwayat.invoice', compact('pemesanan'));
    }
}
