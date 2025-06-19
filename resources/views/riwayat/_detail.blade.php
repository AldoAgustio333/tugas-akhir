<style>
    .riwayat-detail{
        margin-top:30px;
        border-radius:10px;
        overflow:hidden;
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
    }

    .title{
        background-color:orange;
        padding:10px;
        margin-bottom:20px;
    }
   
    table th{
        width:300px;
    }

    .dibayar{
        border-bottom:2px solid gray;
    }

    h4{
        color:white;
    }

    tr{
        margin-top:10px;
    }
</style>


<div class="title">
    <h4>Detail</h4>
</div>
<div id="detail-riwayat" class="riwayat-detail">
    <div class="kiri">
    <div class="body-detail">
        <h5>Rincian Transaksi</h5>
        <table>
            <tr>
                <th style="width: 200px;">Status User:</th>
                <td>{{ ucfirst($pemesanan->user->status ?? '-') }}</td>
            </tr>
            <tr>
                <th>Tanggal Transaksi:</th>
                <td>{{ $pemesanan->tanggal }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran:</th>
                <td>{{ $pemesanan->metode_pembayaran }}</td>
            </tr>
        </table>

         <h5 style="margin-top:30px;">Rincian Pembayaran</h5>
        <table>
            <tr>
                <th>Harga:</th>
                <td>Rp{{ number_format($pemesanan->biaya, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th class="dibayar">Dibayar:</th>
                <td class="dibayar">Rp{{ number_format($pemesanan->biaya, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Lunas:</th>
                <td>Rp{{ number_format($pemesanan->total_biaya, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Detail JBI</h5>
        <table>
            <tr>
                <th>Nama:</th>
                <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>No Hp:</th>
                <td>{{ $pemesanan->jbi->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin:</th>
                <td>{{ $pemesanan->jbi->jk ?? '-' }}</td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Tanggal yang di pesan</h5>
        <table>
            <tr>
                <td><p>{{ $pemesanan->tanggal }}</p></td>
            </tr>
        </table>

        <h5 style="margin-top:30px;">Keterangan</h5>
        <p>{{ $pemesanan->deskripsi ?? '-' }}</p>

         <a href="{{ route('riwayat.invoice', $pemesanan->id) }}" class="btn btn-success mt-2" style="margin-bottom:30px;">
    Cetak Invoice
</a>
    </div>
</div>

    <div class="kanan">
            <h3>Bukti Pembayaran</h3>
            @if (!empty($pemesanan->bukti_pembayaran))
            <img src="{{ asset('uploads/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}" 
                alt="Bukti Pembayaran" 
                class="img-fluid rounded" 
                style="max-width: 300px;">
                @else
                    <p>-</p>
            @endif
    </div>


    
    

    


   
</div>
