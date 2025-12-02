<div class="card h-100">
    <div class="card-header bg-success text-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-receipt me-2"></i>Detail Pesanan #{{ $pemesanan->id }}
        </h5>
    </div>
    <div class="card-body">
        <!-- Status Badge -->
        <div class="text-center mb-4">
            @if($pemesanan->status == 'completed')
                <span class="badge bg-success fs-6 px-3 py-2">
                    <i class="fas fa-check-circle me-1"></i>SELESAI
                </span>
            @elseif($pemesanan->status == 'pending')
                @if($pemesanan->bukti_pembayaran)
                    <span class="badge bg-info fs-6 px-3 py-2">
                        <i class="fas fa-clock me-1"></i>MENUNGGU PERSETUJUAN ADMIN
                    </span>
                @elseif($pemesanan->biaya == 0)
                    <span class="badge bg-info fs-6 px-3 py-2">
                        <i class="fas fa-clock me-1"></i>MENUNGGU PERSETUJUAN ADMIN
                    </span>
                @else
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                        <i class="fas fa-clock me-1"></i>MENUNGGU PEMBAYARAN
                    </span>
                @endif
            @elseif($pemesanan->status == 'disetujui')
                <span class="badge bg-success fs-6 px-3 py-2">
                    <i class="fas fa-thumbs-up me-1"></i>DISETUJUI
                </span>
            @elseif($pemesanan->status == 'ditolak')
                <span class="badge bg-danger fs-6 px-3 py-2">
                    <i class="fas fa-times-circle me-1"></i>DITOLAK
                </span>
            @else
                <span class="badge bg-secondary fs-6 px-3 py-2">{{ strtoupper($pemesanan->status) }}</span>
            @endif
        </div>

        <div class="row">
            <!-- Informasi JBI -->
            <div class="col-md-6 mb-4">
                <h6 class="text-success mb-3">
                    <i class="fas fa-user-tie me-2"></i>Informasi JBI
                </h6>
                <div class="bg-light p-3 rounded">
                    <p class="mb-2"><strong>Nama:</strong> {{ $pemesanan->jbi->nama ?? '-' }}</p>
                    <p class="mb-2"><strong>No. HP:</strong> 
                        @if($pemesanan->jbi->no_hp)
                            <a href="tel:{{ $pemesanan->jbi->no_hp }}" class="text-decoration-none">
                                <i class="fas fa-phone me-1"></i>{{ $pemesanan->jbi->no_hp }}
                            </a>
                        @else
                            -
                        @endif
                    </p>
                    <p class="mb-2"><strong>Jenis Kelamin:</strong> {{ $pemesanan->jbi->jk ?? '-' }}</p>
                    <p class="mb-0"><strong>Keahlian:</strong> {{ $pemesanan->jbi->keahlian ?? '-' }}</p>
                </div>
            </div>

            <!-- Detail Pemesanan -->
            <div class="col-md-6 mb-4">
                <h6 class="text-success mb-3">
                    <i class="fas fa-calendar-alt me-2"></i>Detail Pemesanan
                </h6>
                <div class="bg-light p-3 rounded">
                    <p class="mb-2"><strong>Tanggal:</strong> 
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d F Y') }}
                    </p>
                    <p class="mb-2"><strong>Waktu:</strong> 
                        {{ $pemesanan->jam_awal }} - {{ $pemesanan->jam_akhir }}
                        <small class="text-muted">({{ $pemesanan->durasi_jam ?? 0 }} jam)</small>
                    </p>
                    <p class="mb-2"><strong>Pemesan:</strong> {{ $pemesanan->nama_pemesan }}</p>
                    <p class="mb-0"><strong>Email:</strong> 
                        <a href="mailto:{{ $pemesanan->email }}" class="text-decoration-none">
                            {{ $pemesanan->email }}
                        </a>
                    </p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="col-12 mb-4">
                <h6 class="text-success mb-3">
                    <i class="fas fa-file-alt me-2"></i>Deskripsi Kebutuhan
                </h6>
                <div class="bg-light p-3 rounded">
                    <p class="mb-0">{{ $pemesanan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="col-12 mb-3">
                <h6 class="text-success mb-3">
                    <i class="fas fa-money-bill-wave me-2"></i>Informasi Pembayaran
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Biaya Layanan</strong></td>
                            <td class="text-end">
                                @if($pemesanan->biaya == 0)
                                    <span class="text-success fw-bold">GRATIS</span>
                                @else
                                    Rp {{ number_format($pemesanan->biaya, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                        @if($pemesanan->metode_pembayaran)
                        <tr>
                            <td><strong>Metode Pembayaran</strong></td>
                            <td class="text-end">{{ $pemesanan->metode_pembayaran }}</td>
                        </tr>
                        @endif
                        <tr class="table-success">
                            <td><strong>Total</strong></td>
                            <td class="text-end fw-bold">
                                @if($pemesanan->biaya == 0)
                                    <span class="text-success">GRATIS</span>
                                @else
                                    Rp {{ number_format($pemesanan->biaya, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
    
    <div class="card-footer bg-light">
        <div class="row align-items-center">
            <div class="col-md-6">
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>
                    Dibuat: {{ $pemesanan->created_at->format('d F Y, H:i') }}
                </small>
            </div>
            <div class="col-md-6 text-md-end">
                @if($pemesanan->status == 'pending' && !$pemesanan->bukti_pembayaran && $pemesanan->biaya > 0)
                    <a href="{{ route('pembayaran.lanjutkan', $pemesanan->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-credit-card me-1"></i>Lanjutkan Pembayaran
                    </a>
                @endif
                <a href="{{ route('riwayat.invoice', $pemesanan->id) }}" class="btn btn-success btn-sm" target="_blank">
                    <i class="fas fa-print me-1"></i>Cetak Invoice
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .card-body .col-md-6 {
            margin-bottom: 1rem;
        }
        
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .card-footer .col-md-6 {
            text-align: center !important;
            margin-bottom: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    @media (max-width: 576px) {
        .bg-light p {
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        
        .card-footer .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>