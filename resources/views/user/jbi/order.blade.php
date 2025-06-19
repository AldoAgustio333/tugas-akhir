@extends('layouts.user')

@section('title', 'Formulir Pemesanan JBI')


@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
      * {
    font-family: 'Poppins', sans-serif;
}

input {
    font-size: 10px; /* ubah sesuai keinginan, misalnya 12px */
}

.details p{
    font-size:12px;
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
</style>
<div class="container mt-4">
    <h3 class="mb-4">Formulir Pemesanan</h3>
<p class="" style="color:gray; font-size:12px; margin-top:-15px;">
            <i class="fas fa-home" ></i> Home > Juru Bahasa Isyarat > Order
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
                            <!-- <label for="nama_pemesan" class="form-label">Nama Pemesan</label> -->
                            <span> * Nama Sudah otomatis terisi sesuai login</span>
                            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan"
                            value="{{ Auth::user()->name }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email">
                        </div>
                        
                        <div class="mb-3">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukan No Hp">
                        </div>

                        <div class="mb-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal"  required>
                        </div>

                        <!-- Tambahan di atas button submit -->
                        <div class="row display-flex align-center jusify-center">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <!-- <label for="jam_awal" class="form-label">Dari Jam</label> -->
                                    <input type="time" class="form-control" id="jam_awal" name="jam_awal" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <p>Sampai</p>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <!-- <label for="jam_akhir" class="form-label">Sampai Jam</label> -->
                                    <input type="time" class="form-control" id="jam_akhir" name="jam_akhir" required>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <!-- <label for="deskripsi" class="form-label">Deskripsi Acara / Kebutuhan</label> -->
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required placeholder="Keterangan"></textarea>
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
@push('scripts')
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jamAwal = document.getElementById('jam_awal');
        const jamAkhir = document.getElementById('jam_akhir');
        const estimasiBiaya = document.getElementById('previewBiaya');
        const layanan = document.getElementById('layanan').value; 

        function hitungBiaya() {
            const awal = jamAwal.value;
            const akhir = jamAkhir.value;

            if (!awal || !akhir) {
                estimasiBiaya.textContent = '-';
                return;
            }

            const [jamAwalJam, jamAwalMenit] = awal.split(':').map(Number);
            const [jamAkhirJam, jamAkhirMenit] = akhir.split(':').map(Number);

            const mulai = new Date(0, 0, 0, jamAwalJam, jamAwalMenit);
            const selesai = new Date(0, 0, 0, jamAkhirJam, jamAkhirMenit);

            let durasi = (selesai - mulai) / 3600000; // dalam jam

            biayaHidden.value = 0; 

            if (durasi <= 0) {
                estimasiBiaya.textContent = 'Jam tidak valid';
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
                } else if (durasi <= 6) {
                    biaya = 600000;
                } else {
                    estimasiBiaya.textContent = 'Durasi melebihi batas (maks 6 jam)';
                    return;
                }
            }

            biayaHidden.value = biaya;
            estimasiBiaya.textContent = biaya === 0 ? 'Free' : `Rp ${biaya.toLocaleString()}`;
        }

        jamAwal.addEventListener('change', hitungBiaya);
        jamAkhir.addEventListener('change', hitungBiaya);
    });
</script>
@endpush

@endpush

@endpush

@endsection
