@extends('layouts.user')

@section('title', 'Profil Pengguna')

@section('content')
<style>
   
    .container img{
        width:200px;
        height:200px;
    }

    .container h3{
        margin-top:20px;
    }

    .container-profile{
        /* width:900px; */
        justify-content: flex-start;
        display:flex;
        height:550px;
        padding:10px 10px;
    }

    .kiri{
        width: 30%;
        background-color:#F8F8F8;
        margin-right:30px;
        padding-top:20px;
        border-radius:10px;
    }

    .kanan{
        width:70%;
    }

    th{
        width:150px;
    }

    td, th{
        margin-bottom:20px;
    }

  

</style>
<div class="container">
    <h3>Profile</h3>
</div>
<div class="container container-profile mt-4">
    <div class="kiri">
        
         {{-- Tampilkan foto profil --}}
        @if($user->foto)
            <div class="mb-3 text-center">
                <img src="{{ asset('uploads/' . $user->foto) }}" alt="Foto Profil" width="150" class="rounded-circle shadow">
            </div>
        @else
            <div class="mb-3 text-center">
                <img src="{{ asset('uploads/default-user.png') }}" alt="Default Foto" width="150" class="rounded-circle shadow">
                {{-- Pastikan kamu punya file default-user.png di public/images --}}
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
