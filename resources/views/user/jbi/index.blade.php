@extends('layouts.user')

@section('title', 'Daftar Juru Bahasa Isyarat')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
     * {
    font-family: 'Poppins', sans-serif;
}

    .col-5-per-row {
        width: 20%;
        padding: 10px;
    }

     .col-5-per-row {
        width: 20%;
        padding: 10px;
    }

    .card-custom-bg {
        background-color: green; 
        padding:5px;
    }

    img{
        border-radius:10px;
    }

    .card-img-top {
        object-fit: cover;
        width: 100%;
        height: 200px;
        border-radius: 10px;
    }

.card-custom-bg img{
    height:200px;
}

.cari{
    padding:10px 20px;
    font-size:10px;
}

.jbibody{
    min-height:600px;
}

/* Styles untuk JBI tidak aktif */
.card.inactive {
    opacity: 0.6;
    position: relative;
}

.card.inactive::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.3);
    z-index: 1;
    border-radius: 0.25rem;
}

.card.inactive .btn {
    pointer-events: none;
    cursor: not-allowed;
}

.badge-status {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 2;
    font-size: 10px;
}

/* Responsive Design for JBI cards */
.card-custom-bg {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-custom-bg:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.card-custom-bg img {
    object-fit: cover;
    width: 100%;
    height: 200px;
}

@media (max-width: 1200px) {
    .col-5-per-row {
        width: 25%;
    }
}

@media (max-width: 992px) {
    .col-5-per-row {
        width: 33.333%;
    }
}

@media (max-width: 768px) {
    .col-5-per-row {
        width: 50%;
        padding: 8px;
    }
    .card-custom-bg img {
        height: 180px;
    }
    h3 {
        font-size: 1.5rem;
    }
    .form-control {
        font-size: 12px;
    }
    .about-section {
        padding: 30px 20px;
    }
    .about-section h2 {
        font-size: 1.5rem;
    }
    .about-section .lead {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .col-5-per-row {
        width: 100%;
        padding: 5px;
        margin-bottom: 15px;
    }
    .card-custom-bg img {
        height: 200px;
    }
    .row.g-2 {
        flex-direction: column;
    }
    .row.g-2 .col {
        margin-bottom: 10px;
    }
    h3 {
        font-size: 1.3rem;
    }
    .about-section {
        padding: 20px 15px;
    }
    .about-section h2 {
        font-size: 1.3rem;
    }
    .about-section p {
        font-size: 0.9rem;
    }
}

input::placeholder {
    font-size: 10px; /* ubah sesuai keinginan, misalnya 12px */
}

select.form-control {
    font-size: 10px;
    padding:10px
}

.geser{
    width:100px;
}

.order{
    background-color:#FBBC05;
}

.order:hover{
    background-color:#FBBC05;

}

    @media (max-width: 768px) {
        .col-5-per-row {
            width: 100%; /* Responsif untuk mobile */
        }
    }

    .card {
        margin-bottom: 20px;
    }

    .about-section {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 10px;
        margin-bottom: 40px;
    }
</style>

<div class="container mt-4 jbibody">
    <div class="row mb-4 align-items-center">
<div class="col-md-6">
    <h3 class="mb-0 fw-bold">Juru Bahasa Isyarat</h3>
    <p class="mt-2" style="color:gray; font-size:12px">
        <i class="fas fa-home"></i> 
        <a href="{{ route('user.dashboard') }}" style="text-decoration: none; color:gray;">
            Home
        </a> > Juru Bahasa Isyarat
    </p>
</div>
    <div class="col-md-6">
        <form method="GET" action="{{ route('user.jbi.index') }}">
            <div class="row g-2">
                <div class="col">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama JBI...">
                </div>
                <div class="col">
                    <select name="kategori" class="form-control" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="JBI Tuli" {{ request('kategori') == 'JBI Tuli' ? 'selected' : '' }}>JBI Tuli</option>
                        <option value="JBI Dengar" {{ request('kategori') == 'JBI Dengar' ? 'selected' : '' }}>JBI Dengar</option>
                        <option value="Mentor" {{ request('kategori') == 'Mentor' ? 'selected' : '' }}>Mentor</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary cari">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

    @if($jbis->isEmpty())
        <div class="alert alert-warning">Belum ada data JBI tersedia.</div>
    @else
        <div class="d-flex flex-wrap">
            @foreach($jbis as $jbi)
                <div class="col-5-per-row">
                    <div class="card h-100 d-flex flex-column card-custom-bg {{ $jbi->status !== 'aktif' ? 'inactive' : '' }}">
                        <!-- Status Badge -->
                        @if($jbi->status !== 'aktif')
                            <span class="badge bg-danger badge-status">Tidak Aktif</span>
                        @else
                            <span class="badge bg-success badge-status">Aktif</span>
                        @endif
                        
                        @if($jbi->foto)
                            <img src="{{ asset('uploads/foto_jbi/' . $jbi->foto) }}"
                                class="card-img-top img-fluid"
                                alt="Foto {{ $jbi->nama }}"
                                style="max-height: 300px; object-fit: cover; width: 100%;">
                        @else
                            <img src="{{ asset('img/default.jpg') }}"
                            class="card-img-top img-fluid"
                            alt="Foto Default"
                            style="max-height: 300px; object-fit: cover; width: 100%;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h7 class="card-title text-white" style="font-size: 14px;">{{ $jbi->nama }}</h7>
                            <p class="card-text text-white" style="font-size: 10px;">
                                <strong class="geser" style="font-size: 10px;">Layanan:</strong> {{ $jbi->keahlian }} <br>
                                <strong class="geser" style="font-size: 10px;">Jadwal:</strong> {{ $jbi->jadwal }} <br>
                                <strong class="geser" style="font-size: 10px;">Status:</strong> 
                                <span class="{{ $jbi->status === 'aktif' ? 'text-white' : 'text-warning' }}">
                                    {{ $jbi->status === 'aktif' ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </p>
                            
                            @if($jbi->status === 'aktif')
                                <a href="{{ route('user.jbi.order', $jbi->id) }}" class="btn text-white font-bold btn-sm mt-auto w-100 order">Order</a>
                            @else
                                <button class="btn btn-secondary btn-sm mt-auto w-100" disabled>Tidak Tersedia</button>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endif

    <!-- Pagination if needed -->
    @if($jbis->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jbis->links() }}
        </div>
    @endif
</div>
@endsection
