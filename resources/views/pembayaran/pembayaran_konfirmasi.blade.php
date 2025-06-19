@extends('layouts.user')

@section('content')
<style>
    .info-text {
        font-size: 15px;
        color: #444;
    }

    .copy-btn {
        border: none;
        background-color: #0d6efd;
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        margin-left: 10px;
        font-size: 14px;
        cursor: pointer;
    }

    .copy-btn:hover {
        background-color: #0b5ed7;
    }

    .transfer-number {
        font-weight: bold;
        font-size: 18px;
        letter-spacing: 1px;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 100%; max-width: 480px; background-color: #f8f9fa;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Upload Bukti Pembayaran</h5>

            <div class="mb-3">
                <p class="info-text mb-1">Pembayaran</p>
                <p class="info-text">Silahkan lakukan pembayaran ke nomor yang tertera di bawah ini.<br>
                    Pastikan jumlah yang ditransfer sesuai dan sertakan bukti pembayaran untuk konfirmasi.
                    <strong>Terima kasih!</strong>
                </p>
                <div class="d-flex align-items-center">
                    <span class="transfer-number" id="rekening">8712381627361283</span>
                    <button type="button" class="copy-btn" onclick="copyRekening()">Salin Nomor</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Atas Nama:</label>
                <p class="mb-0">Perhatikan pesanan Anda sudah benar dan pembayaran Anda sebesar 
                    <strong>Rp. {{ number_format($booking->biaya, 0, ',', '.') }}</strong>
                </p>
            </div>

            <form action="{{ route('pembayaran.uploadBukti', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_pembayaran" value="{{ $jenis_metode }}">
                <input type="hidden" name="metode_pembayaran" value="{{ $metode_detail }}">

                <div class="mb-3 mt-4">
                    <label for="bukti_pembayaran" class="form-label">Kirim Bukti Transfer Disini:</label>
                    <input type="file" name="bukti_pembayaran" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Kirim Bukti</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function copyRekening() {
        const nomor = document.getElementById("rekening").textContent;
        navigator.clipboard.writeText(nomor).then(() => {
            alert("Nomor berhasil disalin!");
        });
    }
</script>
@endsection


