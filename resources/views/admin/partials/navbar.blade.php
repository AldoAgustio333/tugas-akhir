<!-- resources/views/admin/partials/navbar.blade.php -->
<nav class="main-header navbar navbar-expand ">

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm text-white">
    Logout <i class="fas fa-sign-out-alt ms-1 mx-2 text-white"></i>
</button>
      </form>
    </li>
  </ul>
</nav>
