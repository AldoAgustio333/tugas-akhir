@extends('layouts.user')

@section('content')
<style>
    .payment-option {
        background-color: #f8f9fa;
        padding: 12px 20px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 10px;
        transition: background-color 0.2s ease;
    }

    .payment-option:hover {
        background-color: #e2e6ea;
    }

    .payment-option input[type="radio"] {
        margin-right: 10px;
    }

    .payment-option input[type="radio"] {
        transform: scale(1.2);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .card {
            margin: 10px;
            padding: 15px;
            max-width: calc(100% - 20px) !important;
        }
        .card-body {
            padding: 20px 15px;
        }
        .payment-option {
            padding: 15px;
            margin-bottom: 12px;
            font-size: 14px;
        }
        h5 {
            font-size: 1.2rem;
        }
        .btn {
            padding: 12px;
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .card {
            margin: 5px;
            padding: 10px;
        }
        .card-body {
            padding: 15px 10px;
        }
        .payment-option {
            padding: 12px;
            font-size: 13px;
        }
        h5 {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 100%; max-width: 480px; background-color: #f0f0f0;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Pilih Jenis Metode Pembayaran</h5>
            <form method="POST" action="{{ route('pembayaran.pembayaran_step2', $id) }}">
                @csrf

                <label class="payment-option d-flex align-items-center">
                    <input type="radio" name="jenis_metode" value="virtual_wallet" required>
                    Virtual Wallet
                </label>

                <label class="payment-option d-flex align-items-center">
                    <input type="radio" name="jenis_metode" value="e_wallet">
                    E-Wallet
                </label>

                <label class="payment-option d-flex align-items-center">
                    <input type="radio" name="jenis_metode" value="qr_code">
                    QR-Code
                </label>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
