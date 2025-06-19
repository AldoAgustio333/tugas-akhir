@extends('layouts.user')

@section('title', 'Invoice Pemesanan')

@section('content')
<style>
    .card-invoice{
        background-color:#EBEBEB;
        padding:20px;
        border-radius:10px;
        max-width:500px;
        margin-bottom:30px;
    }

     table th{
        width:300px;
    }

      .dibayar{
        border-bottom:2px solid gray;
    }

    textarea{
        width:500px;
        background-color:#EBEBEB;
        height:200px;
        outline:none;
        padding:10px;
    }

</style>


<div class="container mt-4">
   <div class="card-invoice">
     <h2 class=" mb-4">Invoice</h2>

    <table>
            <tr>
                <th style="width: 200px;">Status User:</th>
                <td>{{ ucfirst($pemesanan->user->status ?? '-') }}</td>
            </tr>
            <tr>
                <th>Tanggal Transaksi:</th>
                <td>{{ $pemesanan->tanggal }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran:</th>
                <td>{{ $pemesanan->metode_pembayaran }}</td>
            </tr>
        </table>

         <h5 style="margin-top:30px;">Rincian Pembayaran</h5>
        <table>
            <tr>
                <th>Harga:</th>
                <td>Rp{{ number_format($pemesanan->biaya, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th class="dibayar">Dibayar:</th>
                <td class="dibayar">Rp{{ number_format($pemesanan->biaya, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Lunas:</th>
                <td>Rp{{ number_format($pemesanan->total_biaya, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Detail JBI</h5>
        <table>
            <tr>
                <th>Nama:</th>
                <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>No Hp:</th>
                <td>{{ $pemesanan->jbi->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin:</th>
                <td>{{ $pemesanan->jbi->jk ?? '-' }}</td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Tanggal yang di pesan</h5>
        <table>
            <tr>
                <td><p>{{ $pemesanan->tanggal }}</p></td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Keterangan</h5>
        <p>{{ $pemesanan->deskripsi ?? '-' }}</p>

    </div>

    @php
    $sudahReview = \App\Models\Testimoni::where('pemesanan_id', $pemesanan->id)->where('user_id', auth()->id())->exists();
@endphp

@if(!$sudahReview)
    <p>Add A Review</p>
    <form action="{{ route('testimoni.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
        <textarea name="review" placeholder="Masukan Review">{{ old('review') }}</textarea><br>
        <button class="btn btn-success" style="margin-bottom:30px;">Add</button>
    </form>
@else
    <div class="alert alert-info">Kamu sudah memberikan review untuk transaksi ini.</div>
@endif

@if($pemesanan->testimoni)
    <div class="mt-4 mb-4">
        <h5>Review Anda:</h5>
        <div class="p-3 bg-light border rounded">
            <p>{{ $pemesanan->testimoni->review }}</p>
            <small class="text-muted">Dikirim pada: {{ $pemesanan->testimoni->created_at->format('d-m-Y H:i') }}</small>
        </div>
    </div>
@else
    <div class="mt-4">
        <h5>Belum ada review.</h5>
    </div>
@endif




</div>
@endsection
