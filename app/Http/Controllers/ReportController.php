<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jbi;

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

}
