<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light">Logo</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Kelola User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>Kelola JBI</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>Report</p>
          </a>
        </li>
        <!-- Tambahkan menu lainnya di sini -->
      </ul>
    </nav>
  </div>
</aside>
