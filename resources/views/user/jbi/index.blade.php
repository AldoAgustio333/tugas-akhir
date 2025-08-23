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

    img.card-img-top {
    width: 100%;
    height: auto;
    max-height: 300px;
    object-fit: cover;
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
                    <div class="card h-100 d-flex flex-column card-custom-bg">
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
                                <!-- <strong>JK:</strong> {{ $jbi->jk }} <br>
                                <strong>No HP:</strong> {{ $jbi->no_hp }} <br> -->
                                <strong class="geser" style="font-size: 10px;">Jadwal:</strong> {{ $jbi->jadwal }}
                            </p>
                            <a href="{{ route('user.jbi.order', $jbi->id) }}" class="btn text-white font-bold btn-sm mt-auto w-100 order">Order</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endif
</div>
@endsection
