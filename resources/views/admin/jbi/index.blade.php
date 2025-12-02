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

  .tambah{
    background-color: #005C3C  !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.navbar')

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper p-3">
<div style="background-color: orange; color: white; font-weight: bold; font-size: 1.2rem; padding: 10px; margin-bottom: 15px; width: 100%; border-radius: 4px;">
        Jumlah JBI: {{ $jbis->count() }}
    </div>

        <div class="d-flex align-items-center mb-3">
                <h1>Daftar JBI</h1>
                <button class="btn btn-success mx-4 tambah" data-toggle="modal" data-target="#modalTambahJbi">
                    <i class="fas fa-user-plus"></i> Tambah JBI
                </button>
        </div>

        <table class="table table-bordered table-striped">
            
   <thead>
  <tr>
    <th>Nama</th>
        <th>Keahlian</th>
        <th>JK</th>
        <th>No. HP</th>
        <th>Ketersediaan</th>
        <th>Jadwal</th>
        <th>Status</th>
        <th>Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach($jbis as $jbi)
  <tr>
        <td>{{ $jbi->nama }}</td>
        <td>{{ $jbi->keahlian }}</td>
        <td>{{ $jbi->jk }}</td>
        <td>{{ $jbi->no_hp }}</td>
        <td>{{ $jbi->ketersediaan }}</td>
        <td>{{ $jbi->jadwal }}</td>
        <td>{{ $jbi->status }}</td>
    <td>
      <!-- Tombol Detail -->
      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalDetailJbi{{ $jbi->id }}">
        <i class="fas fa-eye"></i>
      </button>

      <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditJbi{{ $jbi->id }}">
  <i class="fas fa-edit"></i>
</button>

      <!-- Tombol Hapus -->
      <form action="{{ route('admin.jbi.destroy', $jbi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus jbi ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">
          <i class="fas fa-trash"></i>
        </button>
      </form>
    </td>
  </tr>
  
  <!-- Modal Detail -->
 <div class="modal fade" id="modalDetailJbi{{ $jbi->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $jbi->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-dark text-center">
        <h5 class="modal-title text-center" id="modalDetailLabel{{ $jbi->id }}">Detail JBI</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

        {{-- Foto di atas --}}
        @if ($jbi->foto)
         <img src="{{ asset('uploads/foto_jbi/' . $jbi->foto) }}" alt="Foto JBI" 
               class="img-fluid rounded-circle mb-3" 
               style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #28a745;">
        @else
          <p><strong>Foto:</strong> Tidak ada foto</p>
        @endif

        {{-- Detail kotak-kotak per baris --}}
        <div style="text-align: left;">
          <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $jbi->nama }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $jbi->keahlian }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;">{{ $jbi->jk }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;">{{ $jbi->no_hp }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;">{{ $jbi->ketersediaan }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;">{{ $jbi->jadwal }}</p>
          <p style="border: 1px solid #6c757d; padding: 8px;">{{ $jbi->alamat }}</p>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditJbi{{ $jbi->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel{{ $jbi->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.jbi.update', $jbi->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header position-relative">
          <h5 class="modal-title position-absolute top-50  text-center w-100">
  Edit JBI
</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">
          <div class="form-group">
            <!-- <label>Nama:</label> -->
            <input type="text" name="nama" value="{{ $jbi->nama }}" class="form-control" required placeholder="Nama">
          </div>

          <div class="form-group">
            <!-- <label>Keahlian:</label> -->
            <input type="text" name="keahlian" value="{{ $jbi->keahlian }}" class="form-control" required placeholder="Keahlian">
          </div>

          <div class="form-group">
            <!-- <label>Jenis Kelamin:</label> -->
            <select name="jk" class="form-control" required>
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki" {{ $jbi->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $jbi->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <!-- <label>No. HP:</label> -->
            <input type="text" name="no_hp" value="{{ $jbi->no_hp }}" class="form-control" required placeholder="No Hp">
          </div>

          <div class="form-group">
            <!-- <label>Ketersediaan:</label> -->
            <select name="ketersediaan" class="form-control" required>
              <option value="">-- Pilih Ketersediaan --</option>
              <option value="Tersedia" {{ $jbi->ketersediaan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
              <option value="Tidak Tersedia" {{ $jbi->ketersediaan == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
          </div>

          <div class="form-group">
            <!-- <label>Jadwal:</label> -->
            <input type="text" name="jadwal" value="{{ $jbi->jadwal }}" class="form-control" required placeholder="Jadwal">
          </div>

          <div class="form-group">
            <input type="time" name="jam" id="jam" class="form-control" placeholder="Jam Tersedia" required>
          </div>

          <div class="form-group">
  <label for="jam_selesai" class="text-dark">Jam Selesai:</label>
  <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
</div>

          <div class="form-group">
            <!-- <label>Alamat:</label> -->
            <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat">{{ $jbi->alamat }}</textarea>
          </div>

          <div class="form-group">
            <!-- <label>Layanan:</label> -->
            <select name="layanan" class="form-control" required>
              <option value="">-- Pilih Layanan --</option>
              <option value="Gratis" {{ $jbi->layanan == 'Gratis' ? 'selected' : '' }}>Gratis</option>
              <option value="Berbayar" {{ $jbi->layanan == 'Berbayar' ? 'selected' : '' }}>Berbayar</option>
            </select>
          </div>

          <select name="status" class="form-control">
    <option value="aktif" {{ $jbi->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
    <option value="tidak aktif" {{ $jbi->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
</select>


          <div class="form-group">
            <label>Foto Baru (opsional):</label>
            <input type="file" name="foto" class="form-control-file">
          </div>
        </div>

        <div class="modal-footer flex-column w-100">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>


  @endforeach
</tbody>
        </table>

    </div>
 <!-- Modal Tambah Jbi -->
<div class="modal fade" id="modalTambahJbi" tabindex="-1" role="dialog" aria-labelledby="modalTambahJbiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.jbi.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header text-dark position-relative">
          <h5 class="modal-title position-absolute top-50 start-50 translate-middle text-center w-100" id="modalTambahJbiLabel">
            Tambah JBI
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="nama" class="form-control" placeholder="Username" required>
          </div>

          <div class="form-group">
            <input type="text" name="keahlian" class="form-control" placeholder="Keahlian" required>
          </div>

          <div class="form-group">
            <select name="jk" class="form-control" required>
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="no_hp" class="form-control" placeholder="No Hp" required>
          </div>

          <div class="form-group">
            <select name="ketersediaan" class="form-control" required>
              <option value="">-- Pilih Ketersediaan --</option>
              <option value="Tersedia">Tersedia</option>
              <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="jadwal" class="form-control" placeholder="Jadwal" required>
          </div>

          <!-- ✅ Tambahan kolom jam tersedia -->
          <div class="form-group">
            <label for="jam_selesai" class="text-dark">Jam Tersedia:</label>
            <input type="time" name="jam" id="jam" class="form-control" placeholder="Jam Tersedia" required>
          </div>

          <div class="form-group">
          <label for="jam_selesai" class="text-dark">Sampai Jam:</label>
          <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>
          <!-- ✅ Akhir tambahan -->

          <div class="form-group">
            <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat"></textarea>
          </div>

          <div class="form-group">
            <select name="layanan" class="form-control" required>
              <option value="">-- Pilih Layanan --</option>
              <option value="Gratis">Gratis</option>
              <option value="Berbayar">Berbayar</option>
            </select>
          </div>

          <div class="form-group">
            <select name="status" id="status" class="form-control">
              <option value="">-- Pilih Status --</option>
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak Aktif</option>
            </select>
          </div>

          <div class="form-group">
            <label>Foto (opsional):</label>
            <input type="file" name="foto" class="form-control-file">
          </div>
        </div>
        
        <div class="modal-footer flex-column w-100">
          <button type="submit" class="btn btn-success w-100 mb-2">Simpan</button>
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Batal</button>
        </div>

      </div>
    </form>
  </div>
</div>


    <!-- Footer -->
    @include('admin.partials.footer')

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


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
