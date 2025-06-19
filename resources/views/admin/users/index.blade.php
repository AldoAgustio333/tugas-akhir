<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>

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
        Jumlah User: {{ $users->count() }}
    </div>

        <div class="d-flex align-items-center mb-3">
                <h1>Daftar User</h1>
                <button class="btn btn-success mx-4 tambah" data-toggle="modal" data-target="#modalTambahUser">
                    <i class="fas fa-user-plus"></i> Tambah User
                </button>
        </div>

        <table class="table table-bordered table-striped">
            
   <thead>
  <tr>
    <!-- <th>ID</th> -->
    <th>Nama</th>
    <th>Email</th>
    <th>JK</th>
    <th>No. HP</th>
    <th>Status</th>
    <th>Role</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach($users as $user)
  <tr>
    <!-- <td>{{ $user->id }}</td> -->
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->jk ?? '-' }}</td>
    <td>{{ $user->no_hp ?? '-' }}</td>
    <td>{{ $user->status ?? '-' }}</td>
    <td>{{ $user->role ?? '-' }}</td>
    <td>
      <!-- Tombol Detail -->
      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalDetailUser{{ $user->id }}">
        <i class="fas fa-eye"></i>
      </button>

      <!-- Tombol Edit -->
    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditUser{{ $user->id }}">
      <i class="fas fa-edit"></i>
    </button>

      <!-- Tombol Hapus -->
      <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">
          <i class="fas fa-trash"></i>
        </button>
      </form>
    </td>
  </tr>
  
  <!-- Modal Detail -->
  <div class="modal fade" id="modalDetailUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-dark">
          <h5 class="modal-title  position-absolute top-50 start-50 translate-middle text-center w-100" id="modalDetailLabel{{ $user->id }}">Detail User</h5>
          <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <p><strong>ID:</strong> {{ $user->id }}</p> -->
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->name }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->email }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->jk }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->jk }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->no_hp }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->status }}</p>
            <p style="border: 1px solid #6c757d; padding: 8px;"> {{ $user->role }}</p>
        </div>
        <div class="modal-footer">
   
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
<div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header text-dark position-relative">
          <h5 class="modal-title position-absolute top-50 start-50 translate-middle text-center w-100" id="modalEditLabel{{ $user->id }}">
            Edit User
          </h5>
          <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
          <div class="form-group">
            <!-- <label>Nama:</label> -->
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required placeholder="Username">
          </div>
          <div class="form-group">
            <!-- <label>Email:</label> -->
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required placeholder="Email">
          </div>
          <div class="form-group">
            <!-- <label>Jenis Kelamin:</label> -->
            <select name="jk" class="form-control" required>
              <option value="">-- Pilih Jenis Kelamin--</option>
              <option value="Laki-laki" {{ $user->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <!-- <label>No. HP:</label> -->
            <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" placeholder="No Hp">
          </div>
          <div class="form-group">
          <!-- <label>Status:</label> -->
          <select name="status" class="form-control" required>
            <option value="">-- Pilih Status --</option>
            <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="ketua uld" {{ $user->status == 'ketua uld' ? 'selected' : '' }}>Ketua ULD</option>
            <option value="umum" {{ $user->status == 'umum' ? 'selected' : '' }}>Umum</option>
            <option value="mahasiswa" {{ $user->status == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
          </select>
        </div>

          <div class="form-group">
            <!-- <label>Role:</label> -->
            <select name="role" class="form-control">
              <option value="">-- Pilih Role --</option>
              <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="ketua_uld" {{ $user->role == 'ketua_uld' ? 'selected' : '' }}>Ketua ULD</option>
              <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User Biasa</option>
            </select>
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
  @endforeach
</tbody>
        </table>

    </div>
    <!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header text-dark position-relative">
          <h5 class="modal-title position-absolute top-50 start-50 translate-middle text-center w-100">
            Tambah User
          </h5>
          <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">
          <div class="form-group">
            <!-- <label>Nama:</label> -->
            <input type="text" name="name" class="form-control" required placeholder="Username">
          </div>
          <div class="form-group">
            <!-- <label>Email:</label> -->
            <input type="email" name="email" class="form-control" required placeholder="Email">
          </div>
          <div class="form-group">
            <!-- <label>Password:</label> -->
            <input type="password" name="password" class="form-control" required placeholder="Password">
          </div>
          <div class="form-group">
            <!-- <label>Jenis Kelamin:</label> -->
            <select name="jk" class="form-control" required>
              <option value="">-- Pilih Jenis Kelamin--</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <!-- <label>No. HP:</label> -->
            <input type="text" name="no_hp" class="form-control" required placeholder="No Hp">
          </div>
          <div class="form-group">
            <!-- <label>Status:</label> -->
            <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="admin">Admin</option>
              <option value="ketua uld">Ketua ULD</option>
              <option value="umum">Umum</option>
              <option value="mahasiswa">Mahasiswa</option>
            </select>
          </div>
          <div class="form-group">
            <!-- <label>Role:</label> -->
            <select name="role" class="form-control">
              <option value="">-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="ketua_uld">Ketua ULD</option>
              <option value="user">User</option>
            </select>
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
