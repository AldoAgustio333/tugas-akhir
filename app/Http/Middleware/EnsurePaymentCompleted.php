<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class EnsurePaymentCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pemesanan = Pemesanan::with('jbi')->find($request->route('id'));

        if ($pemesanan) {
            // Jika layanan gratis, tidak perlu pembayaran
            if ($pemesanan->jbi && $pemesanan->jbi->layanan === 'Gratis') {
                return redirect()->route('riwayat.index')
                    ->with('info', 'Layanan gratis tidak memerlukan proses pembayaran.');
            }
            
            // Jika berbayar dan sudah disetujui, redirect ke riwayat
            if ($pemesanan->status === 'disetujui') {
                return redirect()->route('riwayat.index')
                    ->with('info', 'Pembayaran sudah selesai.');
            }
        }

        return $next($request);
    }
}