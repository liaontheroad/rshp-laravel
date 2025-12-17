<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE 4 | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard featuring over 800 components, 1000+ icons and 20+ pages.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, bootstrap 5 icons, responsive bootstrap 5 admin dashboard, free bootstrap 5 admin dashboard, free bootstrap 5 dashboard, adminlte">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- AdminLTE Theme style -->
   <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    @stack('styles')

    <style>
        .user-image {
            border-radius: 50% !important;
            object-fit: cover;
            width: 32px !important;
            height: 32px !important;
        }
        .user-header img {
            border-radius: 50% !important;
            object-fit: cover;
            width: 80px !important;
            height: 80px !important;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <!-- Start navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- End navbar links -->
                <ul class="navbar-nav ms-auto">
                    <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image img-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle shadow" alt="User Image">
                                <p>
                                    Admin
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RSHP UNAIR</span>
        </a>
    </div>

            <!-- Sidebar -->
<div class="sidebar-wrapper">
    <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            
            {{-- Conditional Menu Rendering (assuming role name is stored in Auth::user()->role_name) --}}
            
            @auth
                
                {{-- 1. ADMIN MENU (Most extensive menu, copied from layouts/dashboard.blade.php) --}}
                @if (Auth::user()->role_name === 'Admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>
                    <li class="nav-header">MANAJEMEN MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i><p>Manajemen User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tag"></i><p>Manajemen Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pemilik.index') }}" class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i><p>Manajemen Pemilik</p>
                        </a>
                    </li>
                    <li class="nav-header">DATA HEWAN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i><p>Jenis Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dog"></i><p>Ras Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        {{-- Assuming 'kategori' in admin.blade.php corresponds to 'kategori-hewan' from dashboard.blade.php --}}
                        <a href="{{ route('admin.kategori-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.kategori-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i><p>Kategori Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-heartbeat"></i><p>Kategori Klinis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cat"></i><p>Manajemen Pasien</p>
                        </a>
                    </li>

                {{-- 2. DOKTER MENU (Inferred routes from filenames) --}}
                @elseif (Auth::user()->role_name === 'Dokter')
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter.pets.index') }}" class="nav-link {{ request()->routeIs('dokter.pets.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Pasien Hari Ini</p>
                        </a>
                    </li>
                
                {{-- 3. PEMILIK MENU (Inferred routes from filenames) --}}
                @elseif (Auth::user()->role_name === 'Pemilik')
                    <li class="nav-item">
                        <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard Pemilik</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pemilik.peliharaan') }}" class="nav-link {{ request()->routeIs('pemilik.peliharaan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Daftar Peliharaan</p>
                        </a>
                    </li>
                
                {{-- 4. RESEPSIONIS MENU (Inferred routes from filenames) --}}
                @elseif (Auth::user()->role_name === 'Resepsionis')
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard Resepsionis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pendaftaran') }}" class="nav-link {{ request()->routeIs('resepsionis.pendaftaran') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Manajemen Pendaftaran</p>
                        </a>
                    </li>

                {{-- 5. PERAWAT MENU (Inferred routes from filenames) --}}
                @elseif (Auth::user()->role_name === 'Perawat')
                    <li class="nav-item">
                        <a href="{{ route('perawat.dashboard') }}" class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard Perawat</p>
                        </a>
                    </li>
                    <li class="nav-header">DATA PASIEN</li>
                    <li class="nav-item">
                        <a href="{{ route('perawat.pets.index') }}" class="nav-link {{ request()->routeIs('perawat.pets.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cat"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>
                    <li class="nav-header">PROFIL</li>
                    <li class="nav-item">
                        <a href="{{ route('perawat.profile.show') }}" class="nav-link {{ request()->routeIs('perawat.profile.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil Perawat</p>
                        </a>
                    </li>

                @endif {{-- End of role check --}}
            @endauth
        </ul>
    </nav>
</div>
    </aside>

        <!-- Main content -->
        <main class="app-main">
            <!-- Main content -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('content-header', 'Page')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @yield('content-header', 'Page')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- /.content -->
        </main>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2014-2025 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- Bootstrap 5 -->
GET http://localhost:8000/adminlte/plugins/fontawesome-free/css/all.min.css net::ERR_ABORTED 404 (Not Found)
dashboard:17   GET http://localhost:8000/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css net::ERR_ABORTED 404 (Not Found)
dashboard:19   GET http://localhost:8000/adminlte/css/adminlte.min.css net::ERR_ABORTED 404 (Not Found)
dashboard:45   GET http://localhost:8000/adminlte/img/user2-160x160.jpg 404 (Not Found)
dashboard:73   GET http://localhost:8000/adminlte/img/AdminLTELogo.png 404 (Not Found)
dashboard:145   GET http://localhost:8000/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js net::ERR_ABORTED 404 (Not Found)
dashboard:148   GET http://localhost:8000/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js net::ERR_ABORTED 404 (Not Found)
dashboard:151   GET http://localhost:8000/adminlte/js/adminlte.min.js net::ERR_ABORTED 404 (Not Found)    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
