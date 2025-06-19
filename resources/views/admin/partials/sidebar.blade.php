<!-- resources/views/admin/partials/sidebar.blade.php -->
<style>
  .main-sidebar, .main-header, .brand-link{
    background-color: #005C3C !important;
    color: white;
  }

  li{
     background-color: #005C3C !important;
  }

  .main-sidebar .nav-link,
  .main-sidebar .nav-icon,
  .main-sidebar .brand-text {
    color: white !important;
    
  }

    .main-sidebar .nav-link {
    background-color: #005C3C; /* warna hijau lebih terang */
    color: white !important;
 
    border-radius: 8px;
  }

  .main-sidebar .nav-link.active {
    background-color: #005C3C !important;
    color: white !important;
  }

  .main-sidebar .nav-link.active {
  font-weight: bold;
  background-color: #00694d !important;
}
</style>


<aside class="main-sidebar elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light">Logo</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-sidebar flex-column" data-widget="treeview">

        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="background-color: #005C3C !important;">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p style="">Dashboard</p>
          </a>
        </li>

        
        @if(Auth::check() && Auth::user()->role === 'ketua_uld')
        <li class="nav-item">
          <a href="{{ route('admin.pemesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}" style="background-color: #005C3C !important;">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>Pemesanan</p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" style="background-color: #005C3C !important;">
            <i class="nav-icon fas fa-user"></i>
            <p>Kelola User</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.jbi.index') }}" class="nav-link {{ request()->routeIs('admin.jbi.*') ? 'active' : '' }}" style="background-color: #005C3C !important;">
            <i class="nav-icon fas fa-hands"></i>
            <p>Kelola JBI</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.report.index') }}" class="nav-link {{ request()->routeIs('admin.report.*') ? 'active' : '' }}" style="background-color: #005C3C !important;">
            <i class="nav-icon fas fa-book"></i>
            <p>Report</p>
          </a>
        </li>


        <!-- Menu lainnya -->
      </ul>
    </nav>
  </div>
</aside>
