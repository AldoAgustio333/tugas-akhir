@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-4">
            <h5>Riwayat Pemesanan</h5>
            <a href="{{ route('riwayat.index') }}" class="btn btn-secondary btn-sm mb-2">← Kembali</a>
            <div class="card">
                <div class="card-body">
                    <h6>{{ $pemesanan->jbi->nama ?? '-' }}</h6>
                    <p>Status: <strong>{{ ucfirst($pemesanan->status) }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-8">
            <h5>Rincian Transaksi</h5>
            <p><strong>Status User:</strong> {{ ucfirst($pemesanan->status) }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ $pemesanan->tanggal }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pemesanan->metode_pembayaran }}</p>

            <h5>Rincian Pembayaran</h5>
            <p><strong>Harga:</strong> Rp.{{ number_format($pemesanan->biaya, 0, ',', '.') }}</p>
            <p><strong>Dibayar:</strong> Rp.{{ number_format($pemesanan->biaya, 0, ',', '.') }}</p>
            <hr>
            <p><strong>LUNAS:</strong> Rp.{{ number_format($pemesanan->total_biaya, 0, ',', '.') }}</p>
            <!-- <p><strong>Status:</strong> <span class="badge bg-success">LUNAS</span></p> -->

            <h5>Detail JBI</h5>
            <p><strong>Nama:</strong> {{ $pemesanan->jbi->nama ?? '-' }}</p>
            <p><strong>No. HP:</strong> {{ $pemesanan->jbi->no_hp ?? '-' }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $pemesanan->jbi->jk ?? '-' }}</p>

            <h5>Tanggal yang Dipesan</h5>
            <p>{{ $pemesanan->tanggal }}</p>

            <h5>Keterangan</h5>
            <p>{{ $pemesanan->deskripsi ?? '-' }}</p>

            <a href="#" class="btn btn-primary mt-2">Cetak Invoice</a>
        </div>
    </div>
</div>
@endsection
