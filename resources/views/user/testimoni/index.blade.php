@extends('layouts.app') {{-- Sesuaikan dengan layout milikmu --}}

@section('title', 'Testimoni')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Testimoni Pengguna</h2>

    @forelse ($testimonis as $testimoni)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $testimoni->user->name ?? 'Anonim' }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    JBI: {{ $testimoni->jbi->nama ?? '-' }}
                </h6>
                <p class="card-text">{{ $testimoni->review }}</p>
                <small class="text-muted">Dikirim pada {{ $testimoni->created_at->format('d M Y') }}</small>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada testimoni.</p>
    @endforelse
</div>
@endsection
