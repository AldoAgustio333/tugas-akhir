@extends('layouts.user')

@section('content')
<style>
    .payment-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .payment-header {
        background: linear-gradient(135deg, #14532d 0%, #22c55e 100%);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .form-control {
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        padding: 12px;
    }
    
    .form-control:focus {
        border-color: #14532d;
        box-shadow: 0 0 0 0.2rem rgba(20, 83, 45, 0.25);
    }
    
    .btn {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 25px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    .upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        background: #f9fafb;
    }
    
    .upload-zone:hover {
        border-color: #14532d;
        background: #f0fdf4;
    }
    
    @media (max-width: 768px) {
        .payment-card {
            margin: 15px;
            border-radius: 15px;
        }
        .payment-header {
            padding: 20px 15px;
        }
        .payment-header h4 {
            font-size: 1.3rem;
        }
        .card-body {
            padding: 20px 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .upload-zone {
            padding: 20px 15px;
        }
        
        /* Tambahkan padding untuk tampilan mobile */
        .card {
            margin: 10px;
            padding: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .payment-card {
            margin: 10px;
        }
        .card-body {
            padding: 15px;
        }
        .payment-header {
            padding: 15px;
        }
        .payment-header h4 {
            font-size: 1.2rem;
        }
        .form-control {
            font-size: 14px;
            padding: 10px;
        }
        .upload-zone {
            padding: 15px;
        }
        
        /* Tambahkan padding untuk tampilan mobile */
        .card {
            margin: 5px;
            padding: 10px;
        }
    }
</style>
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

            <form id="upload-form" action="{{ route('pembayaran.uploadBukti', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_pembayaran" value="{{ $jenis_metode }}">
                <input type="hidden" name="metode_pembayaran" value="{{ $metode_detail }}">

                <div class="mb-3 mt-4">
                    <label for="bukti_pembayaran" class="form-label">
                        <i class="fas fa-upload me-2"></i>Kirim Bukti Transfer Disini:
                    </label>
                    <input type="file" 
                           name="bukti_pembayaran" 
                           id="bukti_pembayaran"
                           class="form-control" 
                           required 
                           accept="image/*,application/pdf" 
                           data-no-validation="true">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Format:</strong> JPG, JPEG, PNG, PDF | <strong>Maksimal:</strong> <span class="text-primary fw-bold">10MB</span>
                    </small>
                    <div class="text-danger" id="file-error" style="display: none;"></div>
                    
                    @if($errors->has('bukti_pembayaran'))
                        <div class="text-danger mt-1">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            {{ $errors->first('bukti_pembayaran') }}
                        </div>
                    @endif
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

    // Validasi ukuran file
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('bukti_pembayaran');
        const errorDiv = document.getElementById('file-error');
        const uploadForm = document.getElementById('upload-form');
        
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const maxSize = 10 * 1024 * 1024; // 10MB dalam bytes
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];
                    
                    // Reset error display
                    errorDiv.style.display = 'none';
                    errorDiv.textContent = '';
                    
                    // Check file size
                    if (file.size > maxSize) {
                        const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
                        errorDiv.textContent = `Ukuran file terlalu besar (${fileSizeMB}MB). Maksimal 10MB.`;
                        errorDiv.style.display = 'block';
                        this.value = '';
                        
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'File Terlalu Besar!',
                                text: `Ukuran file: ${fileSizeMB}MB. Maksimal 10MB.`,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                        return;
                    }
                    
                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        errorDiv.textContent = 'Format file tidak didukung. Hanya JPG, PNG, GIF, atau PDF.';
                        errorDiv.style.display = 'block';
                        this.value = '';
                        
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Format File Tidak Didukung!',
                                text: 'Silakan pilih file JPG, PNG, GIF, atau PDF.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                        return;
                    }
                    
                    // File is valid
                    const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
                    console.log(`File valid: ${file.name}, Size: ${fileSizeMB}MB`);
                }
            });
        }
        
        // Form submit validation
        if (uploadForm) {
            uploadForm.addEventListener('submit', function(e) {
                const file = fileInput.files[0];
                if (!file) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'File Belum Dipilih!',
                            text: 'Silakan pilih file bukti pembayaran terlebih dahulu.',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#ffc107'
                        });
                    } else {
                        alert('Silakan pilih file bukti pembayaran terlebih dahulu.');
                    }
                    return;
                }
                
                // Show loading
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Mengupload...',
                        text: 'Sedang mengupload bukti pembayaran',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                }
            });
        }
    });
</script>
@endsection


