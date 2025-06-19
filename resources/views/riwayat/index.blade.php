@extends('layouts.user')

@section('content')
<div class="container" style="min-height:550px;">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-3 mt-4">
            <h5>Riwayat Pemesanan</h5>
            <ul class="list-group">
                @foreach ($pemesanans as $pemesanan)
    <a href="#" class="list-group-item list-group-item-action riwayat-link" data-id="{{ $pemesanan->id }}">
        {{ $pemesanan->jbi->nama ?? '-' }} <br>
        <small>{{ ucfirst($pemesanan->status) }}</small>
    </a>
@endforeach
            </ul>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-9 mt-4" id="detail-container">
    <!-- <p>Klik salah satu riwayat untuk melihat detailnya.</p> -->
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
