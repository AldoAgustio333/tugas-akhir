<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola JBI</title>

    <!-- AdminLTE CSS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
  .main-sidebar {
    background-color: #28a745 !important; /* Hijau Bootstrap */
  }

  .brand-link, .nav-sidebar > .nav-item > .nav-link {
    background-color: #28a745 !important; 
    color: #fff !important;
  }

  .nav-sidebar .nav-link.active {
    background-color: #218838 !important; /* Hijau gelap saat aktif */
    color: #fff !important;
  }

  p{
    font-weight:bold;
  }

  .modal-body table th{
    width:200px;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.navbar')

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                           <div class="row">
    <!-- Jumlah User -->
                <div class="col-lg-4 col-6">
                        <div class="bg-success p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah User</h5>
                               <p>0</p>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4 col-6">
                        <div class="bg-danger p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah JBI</h5>
                                <p>1</p>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4 col-6">
                        <div class="bg-warning p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-tasks fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah Order</h5>
                             <p class="text-white">0</p>
                            </div>
                        </div>
                    </div>




                <h4 class="mt-5">Pemesanan</h4>
                <table class="table table-bordered mt-3">
                    <thead class=" text-dark">
                        <tr>
                            <th>Pesanan</th>
                            <th>JBI</th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Tarif</th>
                            <th>Bukti TF</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->nama_pemesan }}</td>
                                <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
                                <td>{{ $pemesanan->jam_awal ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ ucfirst($pemesanan->status) ?? '-' }}</td>
                                <td>Rp{{ number_format($pemesanan->biaya ?? 0, 0, ',', '.') }}</td>
                                <td class="text-center">
                                  @if($pemesanan->bukti_pembayaran)
                                      <button class="btn btn-sm text-primary" data-toggle="modal" data-target="#modalBukti{{ $pemesanan->id }}">Lihat</button>

                                      <!-- Modal -->
                                      <div class="modal fade" id="modalBukti{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $pemesanan->id }}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalLabel{{ $pemesanan->id }}">Bukti Pembayaran</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body text-center">
                                                      <img src="{{ asset('uploads/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 500px;">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  @else
                                      <span class="text-muted">Belum ada</span>
                                  @endif

                                </td>
                                <td>
                                   <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalDetail{{ $pemesanan->id }}"><i class="fas fa-eye"></i></button>

                                    <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    

                    @foreach($pemesanans as $pemesanan)
                  <!-- Modal Detail Pemesanan -->
                  <div class="modal fade" id="modalDetail{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $pemesanan->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                          <h5 class="modal-title" id="modalDetailLabel{{ $pemesanan->id }}">Detail Pemesanan</h5>
                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table>
                            <p>Identitas Pemesan</p>
                            <tr>
                              <th>Nama Pemesan</th>
                              <td>{{ $pemesanan->nama_pemesan }}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{ $pemesanan->user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Waktu</th>
                              <td>{{ $pemesanan->jam_awal ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>No_HP</th>
                              <td>{{ $pemesanan->user->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Jenis Kelamin</th>
                              <td>{{ $pemesanan->user->jk ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Status</th>
                              <td>{{ $pemesanan->user->status ?? '-' }}</td>
                            </tr>
                          </table>

                          <table class="">
                                <p style=margin-top:30px;>Identitas JBI</p>
                            <tr>
                              <th>Nama JBI</th>
                              <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{ $pemesanan->jbi->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Jenis Kelamin</th>
                              <td>{{ $pemesanan->jbi->jk ?? '-' }}</td>
                            </tr>
                            <tr>
                              <th>Spesialis</th>
                              <td>{{ $pemesanan->jbi->keahlian ?? '-' }}</td>
                            </tr>
                          </table>

                          <table>
                              <p style=margin-top:30px;>Detail Pemesanan</p>
                                <tr >
                                    <th>Tanggal</th>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d-m-Y') }}</td>
                                  </tr>
                                  <tr>
                                    <th>Waktu</th>
                                    <td>{{ $pemesanan->jam_awal ?? '-' }}</td>
                                  </tr>
                                  <tr>
                                    <th>Tarif</th>
                                    <td>Rp{{ number_format($pemesanan->biaya ?? 0, 0, ',', '.') }}</td>
                                  </tr>
                                  <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($pemesanan->status) ?? '-' }}</td>
                                  </tr> 
                                  <tr>
                                    <th >Bukti Transfer</th>
                                  </tr>
                                  <tr>
                                    <td class="text-center">
                                      <img src="{{ asset('uploads/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 500px;">
                                    </td>
                                  </tr>
                                </table>
                                <div class="text-center mt-3">
                            @if($pemesanan->status === 'pending')
                            <form action="{{ route('admin.pemesanan.terima', $pemesanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-block" style="width: 100%; color: white;">
                                    Terima Pemesanan
                                </button>
                            </form>
                            @else
                                <button class="btn btn-secondary btn-block" style="width: 100%;" disabled>
                                    Sudah Diterima
                                </button>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
</div>

<script>
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '{{ session('success') }}',
      timer: 2000,
      showConfirmButton: false
    });
  @endif

  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '{{ session('error') }}',
      timer: 2000,
      showConfirmButton: false
    });
  @endif
</script>


<!-- AdminLTE Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
