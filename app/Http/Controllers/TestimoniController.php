<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan; // ← INI YANG PENTING
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'pemesanan_id' => 'required|exists:pemesanans,id',
        'review' => 'required|string|max:1000',
    ]);

    $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

    Testimoni::create([
        'user_id' => auth()->id(),
        'jbi_id' => $pemesanan->jbi_id,
        'pemesanan_id' => $pemesanan->id,
        'review' => $request->review
    ]);

    return redirect()->back()->with('success', 'Review berhasil dikirim!');
}
 public function index()
    {
        $testimonis = Testimoni::with('user', 'jbi')->latest()->get();

        return view('testimoni.index', compact('testimonis'));
    }

}
