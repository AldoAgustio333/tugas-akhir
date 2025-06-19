@extends('layouts.user')
@section('title', 'Testimoni')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Testimoni Pengguna</h2>

    <div class="row">
        @forelse ($testimonis as $testimoni)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $testimoni->user->name ?? 'Anonim' }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            JBI: {{ $testimoni->jbi->nama ?? '-' }}
                        </h6>
                        <p class="card-text flex-grow-1">{{ $testimoni->review }}</p>
                        <small class="text-muted mt-2">Dikirim pada {{ $testimoni->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada testimoni.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
