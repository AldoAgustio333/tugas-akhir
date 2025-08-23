<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jbi;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');

    $dataPemesanan = \App\Models\Pemesanan::when($tanggal, function ($query, $tanggal) {
        return $query->whereDate('tanggal', $tanggal);
    })->get();

    $dataJbi = \App\Models\Jbi::all(); // jika diperlukan untuk tabel ke-2

    return view('admin.report.index', compact('dataPemesanan', 'dataJbi'));
    }




    public function pemesanan(Request $request)
{
    $tanggal = $request->input('tanggal');

    $dataPemesanan = \App\Models\Pemesanan::when($tanggal, function ($query, $tanggal) {
        return $query->whereDate('tanggal', $tanggal);
    })->get();

    $dataJbi = \App\Models\Jbi::all(); // jika diperlukan untuk tabel ke-2

    return view('admin.report.index', compact('dataPemesanan', 'dataJbi'));
}

public function exportPdf(Request $request)
{
    $tanggal = $request->tanggal;
    $dataPemesanan = Pemesanan::when($tanggal, function($q) use ($tanggal) {
        $q->whereDate('tanggal', $tanggal);
    })->get();

    $pdf = Pdf::loadView('admin.report.pemesanan_pdf', compact('dataPemesanan', 'tanggal'));
    return $pdf->download('laporan_pemesanan.pdf');
}

public function exportPdfJbi()
{
    $dataJbi = Jbi::all();

    $pdf = Pdf::loadView('admin.report.ketersediaan_pdf', compact('dataJbi'));
    return $pdf->download('laporan_jbi.pdf');
}


}
