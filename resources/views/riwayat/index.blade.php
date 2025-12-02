@extends('layouts.user')

@section('content')
<style>
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .list-group-item {
        border-radius: 10px;
        border: none;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .section-title {
        color: #14532d;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #22c55e;
        border-radius: 2px;
    }
    
    @media (max-width: 768px) {
        .col-md-3 {
            margin-bottom: 30px;
        }
        .list-group-item {
            font-size: 14px;
            padding: 15px;
        }
        .section-title {
            font-size: 1.2rem;
            text-align: center;
        }
        .section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
    }
    
    @media (max-width: 576px) {
        .container {
            padding: 0 15px;
        }
        .list-group-item {
            padding: 12px;
            font-size: 13px;
        }
        .section-title {
            font-size: 1.1rem;
        }
    }
</style>
<div class="container" style="min-height:550px;">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-3 mt-4">
            <h5 class="section-title">Riwayat Selesai</h5>
            <div class="card">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($pemesanansCompleted as $pemesanan)
                            <li class="list-group-item riwayat-link" role="button" data-id="{{ $pemesanan->id }}">
                                <strong>{{ $pemesanan->jbi->nama ?? '-' }}</strong><br>
                                <small class="text-success"><i class="fas fa-check-circle me-1"></i>{{ ucfirst($pemesanan->status) }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">
                                <i class="fas fa-inbox mb-2 d-block"></i>
                                Belum ada riwayat selesai
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-4">
            <h5 class="section-title">Belum Selesai</h5>
            <div class="card">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($pemesanansIncomplete as $pemesanan)
                            <li class="list-group-item riwayat-link" role="button" data-id="{{ $pemesanan->id }}">
                                <strong>{{ $pemesanan->jbi->nama ?? '-' }}</strong><br>
                                @if($pemesanan->bukti_pembayaran)
                                    <small class="text-info"><i class="fas fa-clock me-1"></i>Menunggu Persetujuan</small>
                                @elseif($pemesanan->biaya == 0)
                                    <small class="text-info"><i class="fas fa-clock me-1"></i>Menunggu Persetujuan</small>
                                @else
                                    <small class="text-warning"><i class="fas fa-credit-card me-1"></i>Menunggu Pembayaran</small>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">
                                <i class="fas fa-inbox mb-2 d-block"></i>
                                Tidak ada pemesanan tertunda
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan - Detail -->
        <div class="col-md-6 mt-4" id="detail-container">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    <i class="fas fa-hand-pointer text-muted mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">Pilih Riwayat Pesanan</h5>
                    <p class="text-muted">Klik salah satu item di sebelah kiri untuk melihat detail lengkap pesanan Anda.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.riwayat-link').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');

            $.ajax({
                url: '/riwayat/' + id,
                method: 'GET',
                success: function(response) {
                    $('#detail-container').html(response);
                },
                error: function() {
                    alert('Gagal memuat detail riwayat.');
                }
            });
        });
    });
</script>

@endsection
