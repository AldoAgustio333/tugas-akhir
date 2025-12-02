@extends('layouts.user')

@section('title', 'Formulir Pemesanan JBI')


@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
      * {
        font-family: 'Poppins', sans-serif;
    }

/* Ensure proper layout and prevent navbar issues */
body {
    position: relative;
    margin: 0;
    padding-top: 0;
}

.navbar {
    position: relative !important;
    z-index: 1030 !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
}

/* Ensure container doesn't overlap navbar */
.container {
    position: relative;
    z-index: 1;
}

input {
    font-size: 10px; /* ubah sesuai keinginan, misalnya 12px */
}

.details p{
    font-size:12px;
}

/* Enhanced Form Styling */
.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.form-control, .form-select {
    border-radius: 10px;
    border: 2px solid #e5e7eb;
    transition: border-color 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #14532d;
    box-shadow: 0 0 0 0.2rem rgba(20, 83, 45, 0.25);
}

.btn {
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    .card {
        margin-bottom: 20px;
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
        padding: 12px;
    }
    h4 {
        font-size: 1.3rem;
        text-align: center;
        margin-bottom: 25px;
    }
    input, select, textarea {
        font-size: 14px;
    }
    .col-md-6 {
        margin-bottom: 15px;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 15px;
    }
    .form-control {
        font-size: 14px;
    }
    .btn {
        font-size: 14px;
        padding: 10px;
    }
    .details p {
        font-size: 12px;
    }
    h4 {
        font-size: 1.2rem;
    }
}

td{
    font-size:10px;
}

.detJbi{
    width:150px;
}

select.form-control {
    font-size: 10px;
    padding:10px
}

    span{
        color:red;
        font-size:9px;
    }

    .layanan{
        background-color: green;
    }

     .form-control {
        font-size: 12px; /* ubah ke ukuran yang kamu mau, misal 10px */
    }

    .ahli{
        background-color:green;
        color:white;
        text-align:center;
        border-radius:5px;
    }

    .ahli p{
        padding:10px;
    }
</style>
<div class="container mt-4">
    <h3 class="mb-4">Formulir Pemesanan</h3>
<p class="mt-2" style="color:gray; font-size:12px">
        <i class="fas fa-home"></i> 
        <a href="{{ route('user.dashboard') }}" style="text-decoration: none; color:gray;">
            Home
        </a> > Juru Bahasa Isyarat > Order
    </p>
    <div class="row">
        <!-- Kolom Kiri: Profil JBI -->
        <div class="col-md-3 mb-4 details">
            <div class="card" style="background-color:#EDEDED">
                <div class="card-body">
                    <div class="img-cards text-center">
                        @if($jbi && $jbi->foto)
                        <img src="{{ asset('uploads/foto_jbi/' . $jbi->foto) }}"
                             alt="Foto {{ $jbi->nama }}"
                             class="rounded-circle mb-3"
                             style="width: 120px; height: 120px; object-fit: cover; ">
                    @else
                        <img src="{{ asset('img/default.jpg') }}"
                             alt="Foto Default"
                             class="rounded-circle mb-3"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @endif
                    </div>

                    <table style="width: 100%; border-collapse: collapse;">
    <tr>
        <h5 style="text-align:center;">{{ $jbi->nama ?? '-' }}</h5>
    </tr>
    <tr>
        <div class="ahli">
            <p >{{ $jbi->keahlian ?? '-' }}</p>
        </div>
    </tr>
    <tr class="mt-3">
        <td style="padding: 4px 0; font-weight: bold;">Jenis Kelamin</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">{{ $jbi->jk ?? '-' }}</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; font-weight: bold;">Jadwal</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">{{ $jbi->jadwal ?? '-' }}</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; font-weight: bold;">Tipe Layanan</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">
            <span class="badge bg-primary">{{ $jbi->layanan ?? '-' }}</span>
        </td>
    </tr>
    <tr>
        <td style="padding: 4px 0; font-weight: bold;">Status</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">
            @if($jbi->status === 'aktif')
                <span class="badge bg-success">Aktif</span>
            @else
                <span class="badge bg-secondary">Tidak Aktif</span>
            @endif
        </td>
    </tr>
    <tr>
        <td style="padding: 4px 0; font-weight: bold;">Jam Tersedia</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">
            <span class="badge bg-success">{{ $jbi->jam ?? '-' }}</span>
            <span class="badge bg-primary">-</span>
            <span class="badge bg-danger">{{ $jbi->jam_selesai ?? '-' }}</span>
        </td>
    </tr>
    <tr>
        <td style="padding: 4px 0; font-weight: bold;">Rating</td>
        <td style="padding: 4px 10px;">:</td>
        <td style="padding: 4px 0;">
            <span class="text-warning fs-5">★★★★☆</span>
        </td>
    </tr>
</table>

                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3><strong>Formulir</strong></h3>
                    <form action="{{ route('user.jbi.storeOrder') }}" method="POST">
                        @csrf
                        <input type="hidden" id="layanan" value="{{ $jbi->layanan }}">
                        <input type="hidden" name="jbi_id" value="{{ $jbi->id }}">
                        
                        <div class="mb-3">
                            <label for="nama_pemesan" class="form-label">
                                <i class="fas fa-user me-1"></i>Nama Pemesan <span class="text-danger">*</span>
                            </label>
                            <span class="small text-muted">Nama sudah otomatis terisi sesuai login</span>
                            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan"
                            value="{{ Auth::user()->name }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email" 
                            placeholder="Masukan Email" value="{{ Auth::user()->email ?? '' }}" required>
                            <small class="text-muted">Email wajib diisi untuk konfirmasi pemesanan</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">
                                <i class="fas fa-phone me-1"></i>No Handphone <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" 
                            placeholder="Contoh: 081234567890" value="{{ Auth::user()->no_hp ?? '' }}" required>
                            <small class="text-muted">Nomor HP wajib diisi untuk koordinasi dengan JBI</small>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">
                                <i class="fas fa-calendar me-1"></i>Tanggal Pemesanan <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required 
                            min="{{ date('Y-m-d') }}">
                            <small class="text-muted">Pilih tanggal sesuai jadwal JBI: {{ $jbi->jadwal }}</small>
                        </div>

                        <!-- Waktu Pelayanan -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-clock me-1"></i>Waktu Pelayanan <span class="text-danger">*</span>
                            </label>
                            <small class="text-muted d-block mb-2">Jam kerja JBI: {{ $jbi->jam ?? 'Tidak ditentukan' }} - {{ $jbi->jam_selesai ?? 'Tidak ditentukan' }}</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="jam_awal" class="form-label">Dari Jam</label>
                                    <input type="time" class="form-control" id="jam_awal" name="jam_awal" required>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                <p class="mb-0">Sampai</p>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="jam_akhir" class="form-label">Sampai Jam</label>
                                    <input type="time" class="form-control" id="jam_akhir" name="jam_akhir" required>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-edit me-1"></i>Deskripsi Kebutuhan <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required 
                            placeholder="Jelaskan kebutuhan layanan JBI Anda (contoh: acara seminar, rapat, dll)"></textarea>
                            <small class="text-muted">Berikan detail kebutuhan layanan untuk membantu JBI mempersiapkan diri</small>
                        </div>

                        <!-- Optional preview biaya & durasi -->
                        <div class="mb-3 display-flex align-center justify-center">
                           <div class="" style="text-align:right;">
                             <span>Jika Biaya 0 maka JBI tersebut tidak dikenakan biaya</span><br>
                            <label class="form-label" style="font-weight:bold;">Total Harga:</label>
                            <p id="previewBiaya" class="fw-bold text-warning">-</p>
                            <input type="hidden" name="biaya" id="biayaHidden" value="0">
                           </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Order Now</button>          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-5 bg-light" id="testimoni">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Testimoni</h2>

        <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row justify-content-center gx-4">
                        <!-- Card 1 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 1" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 2" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row justify-content-center gx-4">
                        <!-- Card 3 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 3" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                                <i class="bi bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 4" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</section>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jamAwal = document.getElementById('jam_awal');
        const jamAkhir = document.getElementById('jam_akhir');
        const estimasiBiaya = document.getElementById('previewBiaya');
        const biayaHidden = document.getElementById('biayaHidden');
        const layanan = "{{ $jbi->layanan }}";
        
        // Jam kerja JBI
        const jamMulaiJBI = "{{ $jbi->jam ?? '00:00' }}";
        const jamSelesaiJBI = "{{ $jbi->jam_selesai ?? '23:59' }}";

        function validasiJamKerja(jam) {
            if (!jamMulaiJBI || !jamSelesaiJBI) return true; // Jika tidak ada jam kerja, anggap valid
            
            return jam >= jamMulaiJBI && jam <= jamSelesaiJBI;
        }

        function hitungBiaya() {
            if (!jamAwal.value || !jamAkhir.value) {
                estimasiBiaya.textContent = '-';
                biayaHidden.value = 0;
                return;
            }

            // Validasi jam kerja JBI
            if (!validasiJamKerja(jamAwal.value)) {
                estimasiBiaya.textContent = `Jam mulai di luar jam kerja JBI (${jamMulaiJBI} - ${jamSelesaiJBI})`;
                biayaHidden.value = 0;
                return;
            }

            if (!validasiJamKerja(jamAkhir.value)) {
                estimasiBiaya.textContent = `Jam selesai di luar jam kerja JBI (${jamMulaiJBI} - ${jamSelesaiJBI})`;
                biayaHidden.value = 0;
                return;
            }

            let mulai = new Date(`1970-01-01T${jamAwal.value}:00`);
            let selesai = new Date(`1970-01-01T${jamAkhir.value}:00`);

            if (selesai <= mulai) {
                estimasiBiaya.textContent = 'Jam selesai harus setelah jam mulai';
                biayaHidden.value = 0;
                return;
            }

            let durasi = (selesai - mulai) / 3600000; // dalam jam

            if (durasi <= 0) {
                estimasiBiaya.textContent = 'Jam tidak valid';
                biayaHidden.value = 0;
                return;
            }

            if (durasi > 6) {
                estimasiBiaya.textContent = 'Durasi melebihi batas (maksimal 6 jam)';
                biayaHidden.value = 0;
                return;
            }

            let biaya = 0;

            if (layanan === 'Gratis') {
                biaya = 0;
            } else {
                if (durasi <= 2) {
                    biaya = 150000;
                } else if (durasi <= 4) {
                    biaya = 300000;
                } else {
                    biaya = 600000;
                }
            }

            biayaHidden.value = biaya;
            estimasiBiaya.textContent = biaya === 0 ? 'Gratis' : `Rp ${biaya.toLocaleString('id-ID')}`;
        }

        // Event listeners
        jamAwal.addEventListener('change', hitungBiaya);
        jamAkhir.addEventListener('change', hitungBiaya);
        jamAwal.addEventListener('input', hitungBiaya);
        jamAkhir.addEventListener('input', hitungBiaya);
        
        // Form submission validation
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!validasiJamKerja(jamAwal.value) || !validasiJamKerja(jamAkhir.value)) {
                e.preventDefault();
                alert(`Jam pemesanan harus dalam jam kerja JBI: ${jamMulaiJBI} - ${jamSelesaiJBI}`);
            }
        });
    });
</script>
@endpush

@endsection
