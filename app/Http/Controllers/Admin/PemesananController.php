<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
        public function index()
        {
            $pemesanans = Pemesanan::with('jbi', 'user')->latest()->get();
            return view('admin.pemesanan.index', compact('pemesanans'));
        }

        public function show($id)
        {
            $pemesanan = Pemesanan::with('jbi')->findOrFail($id);
            return view('admin.pemesanan.show', compact('pemesanan'));
        }

        public function destroy($id)
        {
            $pemesanan = Pemesanan::findOrFail($id);
            if ($pemesanan->bukti_tf && file_exists(public_path('uploads/bukti_tf/' . $pemesanan->bukti_tf))) {
                unlink(public_path('uploads/bukti_tf/' . $pemesanan->bukti_tf));
            }
            $pemesanan->delete();
            return redirect()->route('admin.pemesanan.index')->with('success', 'Data pemesanan berhasil dihapus.');
        }

public function terima($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->status = 'disetujui';
    $pemesanan->save();

    // update ketersediaan JBI terkait
    if ($pemesanan->jbi) {
        $pemesanan->jbi->ketersediaan = 'Tidak tersedia';
        $pemesanan->jbi->save();
    }

    return redirect()->back()->with('success', 'Pemesanan berhasil diterima dan ketersediaan diperbarui.');
}



        public function ajaxShow($id)
        {
            $pemesanan = Pemesanan::with('jbi', 'user')->findOrFail($id);
            return view('riwayat._detail', compact('pemesanan'));
        }

}
