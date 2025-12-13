<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - RSHP UNAIR</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">RSHP UNAIR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Manajemen User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>Manajemen Role</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-paw"></i>
              <p>Jenis Hewan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-dog"></i>
              <p>Ras Hewan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.kategori-hewan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Kategori Hewan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>Kategori Klinis</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.pemilik.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>Manajemen Pemilik</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.pets.index') }}" class="nav-link">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>Manajemen Pasien</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title ?? 'Dashboard' }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{ $slot }}
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/js/adminlte.min.js') }}"></script>
</body>
</html>