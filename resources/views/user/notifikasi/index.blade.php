@extends('layouts.user') 

@section('title', 'Notifikasi')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Notifikasi</h4>
    @forelse($notifikasi as $notif)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $notif['judul'] }}</h5>
                <p class="card-text">{{ $notif['pesan'] }}</p>
                <small class="text-muted">{{ $notif['tanggal'] }}</small>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada notifikasi.</div>
    @endforelse
</div>
@endsection
