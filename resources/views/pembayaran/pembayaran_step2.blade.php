@extends('layouts.user')

@section('content')
<style>
    .payment-detail-option {
        background-color: #f8f9fa;
        padding: 12px 20px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 10px;
        transition: background-color 0.2s ease;
    }

    .payment-detail-option:hover {
        background-color: #e2e6ea;
    }

    .payment-detail-option input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.2);
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 100%; max-width: 480px; background-color: #f0f0f0;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Pilih Metode Pembayaran Detail</h5>
            <form method="POST" action="{{ route('pembayaran.pembayaran_konfirmasi', $id) }}">
                @csrf
                <input type="hidden" name="jenis_metode" value="{{ $jenis_metode }}">

                <label class="payment-detail-option d-flex align-items-center">
                    <input type="radio" name="metode_detail" value="seabank" required>
                    Seabank
                </label>

                <label class="payment-detail-option d-flex align-items-center">
                    <input type="radio" name="metode_detail" value="dana">
                    Dana
                </label>

                <label class="payment-detail-option d-flex align-items-center">
                    <input type="radio" name="metode_detail" value="gopay">
                    GoPay
                </label>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Lanjut ke Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
