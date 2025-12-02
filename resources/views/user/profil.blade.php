@extends('layouts.user')

@section('title', 'Profil Pengguna')

@section('content')
<style>
    .profile-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #14532d 0%, #22c55e 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        margin: auto; /* Center secara horizontal */
        display: block;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .form-control {
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        padding: 12px;
    }
    
    .form-control:focus {
        border-color: #14532d;
        box-shadow: 0 0 0 0.2rem rgba(20, 83, 45, 0.25);
    }
    
    .btn {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 25px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    @media (max-width: 768px) {
        .profile-card {
            margin: 15px;
            border-radius: 15px;
        }
        .profile-header {
            padding: 25px 15px;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
        }
        .card-body {
            padding: 20px 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        .row {
            margin: 0;
        }
        .col-md-6 {
            padding: 0 5px;
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .profile-card {
            margin: 10px;
            border-radius: 15px;
        }
        .container {
            padding: 0 10px;
        }
        .card-body {
            padding: 15px;
        }
        .profile-header {
            padding: 20px 15px;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
        }
        .form-control {
            font-size: 14px;
            padding: 10px;
        }
        h4 {
            font-size: 1.2rem;
        }
        .btn {
            font-size: 14px;
        }
    }
    
    /* Tablet responsiveness */
    @media (min-width: 769px) and (max-width: 1024px) {
        .container {
            max-width: 95%;
        }
        .profile-card {
            margin: 20px;
        }
        .profile-header {
            padding: 25px;
        }
        .row .col-md-6 {
            padding: 0 10px;
        }
    }

    .container-profile {
        justify-content: flex-start;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .kiri {
        display: flex;
        flex-direction: column;
        justify-content: center; /* Center secara vertikal */
        align-items: center;
        flex: 1 1 250px;
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .kanan {
        flex: 2 1 500px;
    }

    th {
        width: 150px;
        text-align: left;
        padding: 8px 0;
        color: #333;
    }

    td {
        padding: 8px 0;
        color: #555;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table tr:not(:last-child) {
        border-bottom: 1px solid #e5e7eb;
    }

    .btn {
        margin-top: 20px;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #14532d;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #22c55e;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 768px) {
        .container-profile {
            flex-direction: column;
            padding: 15px;
        }

        .kiri {
            margin-bottom: 20px;
        }

        th, td {
            font-size: 0.9rem;
        }

        .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .container-profile {
            padding: 10px;
        }

        th, td {
            font-size: 0.8rem;
        }

        .btn {
            font-size: 0.9rem;
        }
    }
</style>
<div class="container">
    <h3 class="text-center">Profil Pengguna</h3>
</div>
<div class="container container-profile mt-4">
    <div class="kiri">
        @if($user->foto)
            <div class="mb-3 text-center">
                <img src="{{ asset('uploads/' . $user->foto) }}" alt="Foto Profil" class="profile-avatar">
            </div>
        @else
            <div class="mb-3 text-center">
                <img src="{{ asset('uploads/default-user.png') }}" alt="Default Foto" class="profile-avatar">
            </div>
        @endif
    </div>
    <div class="kanan">
        <table>
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $user->jk ?? '-' }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $user->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($user->status) }}</td>
            </tr>

            @if(strtolower($user->status) === 'mahasiswa')
                <tr>
                    <th>NIM</th>
                    <td>{{ $user->npm ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td>{{ $user->fakultas ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $user->program_studi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $user->kelas ?? '-' }}</td>
                </tr>
            @endif
        </table>

        <!-- Tombol Edit Profil (trigger modal) -->
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            Edit Profil
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label>Nama</label>
                      <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>No HP</label>
                      <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>Jenis Kelamin</label>
                      <select name="jk" class="form-control" required>
                          <option value="Laki-laki" {{ $user->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>Status</label>
                      <select name="status" class="form-control" required>
                          <option value="umum" {{ $user->status == 'umum' ? 'selected' : '' }}>Umum</option>
                          <option value="mahasiswa" {{ $user->status == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                      </select>
                  </div>
                  @if(strtolower($user->status) === 'mahasiswa')
                      <div class="col-md-6 mb-3">
                          <label>NIM</label>
                          <input type="text" name="npm" class="form-control" value="{{ $user->npm }}">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label>Fakultas</label>
                          <input type="text" name="fakultas" class="form-control" value="{{ $user->fakultas }}">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label>Program Studi</label>
                          <input type="text" name="program_studi" class="form-control" value="{{ $user->program_studi }}">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label>Kelas</label>
                          <input type="text" name="kelas" class="form-control" value="{{ $user->kelas }}">
                      </div>
                  @endif
                  <div class="col-md-6 mb-3">
                      <label>Foto Profil</label>
                      <input type="file" name="foto" class="form-control">
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
    </form>
  </div>
</div>

@endsection
