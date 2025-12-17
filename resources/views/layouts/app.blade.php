<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>RSHP UNAIR | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/css/adminlte.min.css') }}">

    {{-- CSS OVERRIDE: Memastikan icon toggle sidebar berwarna hitam --}}
    <style>
        .app-header .navbar-nav .nav-link .fa-bars {
            color: #000000 !important;
        }
    </style>

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @php
        $userRole = session('user_role'); 
        $dashboardRoute = 'home';
        
        // Menentukan route dashboard berdasarkan role
        if ($userRole == 1) $dashboardRoute = 'admin.dashboard';
        elseif ($userRole == 2) $dashboardRoute = 'dokter.dashboard';
        elseif ($userRole == 3) $dashboardRoute = 'perawat.dashboard';
        elseif ($userRole == 4) $dashboardRoute = 'resepsionis.dashboard';
        elseif ($userRole == 5) $dashboardRoute = 'pemilik.dashboard';
    @endphp

    <div class="app-wrapper">
        <!-- Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
               <ul class="navbar-nav">
                    <li class="nav-item">
                        {{-- Hanya satu tombol toggle yang bersih --}}
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('AdminLTE-4.0.0-rc4/dist/assets/img/user2-160x160.jpg') }}" class="user-image img-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name ?? Auth::user()->nama ?? 'Guest' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> 
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                {{-- Placeholder --}}
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                
                                {{-- LOGOUT BUTTON AND FORM --}}
                                <a class="btn btn-default btn-flat float-end" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
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
        {{-- FIX: Link Brand mengarah ke dashboard sesuai role --}}
        <a href="{{ route($dashboardRoute) }}" class="brand-link">
            <img src="{{ asset('AdminLTE-4.0.0-rc4/dist/assets/img/AdminLTELogo.png') }}" alt="RSHP Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RSHP Dashboard</span>
        </a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">

            {{-- ================================================= --}}
            {{-- ADMIN MENU (role_id == 1) --}}
            {{-- ================================================= --}}
            @if($userRole == 1)
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">MANAJEMEN DATA (MASTER)</li>
                    <li class="nav-item"><a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}"><i class="nav-icon fas fa-paw"></i><p>Jenis Hewan</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.ras-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}"><i class="nav-icon fas fa-dog"></i><p>Ras Hewan</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"><i class="nav-icon fas fa-tags"></i><p>Kategori</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}"><i class="nav-icon fas fa-clipboard-list"></i><p>Kategori Klinis</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="nav-link {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}"><i class="nav-icon fas fa-hand-holding-medical"></i><p>Kode Tindakan & Terapi</p></a></li>

                    <li class="nav-header">MANAJEMEN PENGGUNA</li>
                    <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="nav-icon fas fa-users"></i><p>User Akun</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-tag"></i><p>Role Akses</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.pemilik.index') }}" class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-friends"></i><p>Data Pemilik</p></a></li>
                    
                    <li class="nav-header">MANAJEMEN PASIEN</li>
                    <li class="nav-item"><a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}"><i class="nav-icon fas fa-heartbeat"></i><p>Data Pasien (Hewan)</p></a></li>

                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

            {{-- ================================================= --}}
            {{-- DOKTER MENU (role_id == 2) --}}
            {{-- ================================================= --}}
            @if($userRole == 2)
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">KLINIK VETERINER</li>
                    <li class="nav-item">
                        <a href="{{ route('dokter.pets.index') }}" class="nav-link {{ request()->routeIs('dokter.pets.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>View Data Pasien</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('dokter.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('dokter.rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Rekam Medis (CRUD)</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.profile.show') }}" class="nav-link {{ request()->routeIs('dokter.profile.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil Dokter</p>
                        </a>
                    </li>

                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

            {{-- ================================================= --}}
            {{-- PERAWAT MENU (role_id == 3) --}}
            {{-- ================================================= --}}
            @if($userRole == 3)
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('perawat.dashboard') }}" class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">KLINIK VETERINER</li>
                    <li class="nav-item">
                       
                        <a href="{{ route('perawat.pets.index') }}" class="nav-link {{ request()->routeIs('perawat.pets.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cat"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Rekam Medis </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.profile.index') }}" class="nav-link {{ request()->routeIs('perawat.profile.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil Perawat</p>
                        </a>
                    </li>

                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

            {{-- ================================================= --}}
            {{-- RESEPSIONIS MENU (role_id == 4) --}}
            {{-- ================================================= --}}
            @if($userRole == 4)
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">MANAJEMEN DATA PASIEN</li>
                    <li class="nav-item"><a href="{{ route('resepsionis.pets.index') }}" class="nav-link {{ request()->routeIs('resepsionis.pets.*') ? 'active' : '' }}"><i class="nav-icon fas fa-heartbeat"></i><p>Data Pasien (Hewan)</p></a></li>
                    <li class="nav-item"><a href="{{ route('resepsionis.pemilik.index') }}" class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-friends"></i><p>Data Pemilik</p></a></li>

                    <li class="nav-header">MANAJEMEN TEMU DOKTER</li>
                    <li class="nav-item"><a href="{{ route('resepsionis.temu-dokter.index') }}" class="nav-link {{ request()->routeIs('resepsionis.temu-dokter.*') ? 'active' : '' }}"><i class="nav-icon fas fa-calendar-check"></i><p>Janji Temu Dokter</p></a></li>
                    
                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

            {{-- ================================================= --}}
            {{-- PEMILIK MENU (role_id == 5) --}}
            {{-- ================================================= --}}
            @if($userRole == 5)
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gauge"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">DATA PELIHARAAN</li>
                    <li class="nav-item"><a href="{{ route('pemilik.pets.index') }}" class="nav-link {{ request()->routeIs('pemilik.pets.*') ? 'active' : '' }}"><i class="nav-icon fas fa-paw"></i><p>Data Peliharaan Saya</p></a></li>

                    <li class="nav-header">JADWAL KLINIK</li>
                    <li class="nav-item"><a href="{{ route('pemilik.temu-dokter.index') }}" class="nav-link {{ request()->routeIs('pemilik.temu-dokter.*') ? 'active' : '' }}"><i class="nav-icon fas fa-calendar-check"></i><p>Janji Temu Dokter</p></a></li>
                    <li class="nav-item"><a href="{{ route('pemilik.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('pemilik.rekam-medis.*') ? 'active' : '' }}"><i class="nav-icon fas fa-history"></i><p>Rekam Medis</p></a></li>
                    
                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

        </nav>
    </div>
    <!-- /.sidebar -->
    
    {{-- Hapus sidebar-footer yang redundan --}}
</aside>

<!-- Main content -->
<main class="app-main">
    <!-- Main content header (Breadcrumb & Title) -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">@yield('content-header', 'Page')</h3>
                </div>
                <div class="col-sm-6">
                    {{-- FIX: Breadcrumb Home Link mengarah ke dashboard yang benar --}}
                    <ol class="breadcrumb float-sm-end text-dark"> 
                        <li class="breadcrumb-item"><a href="{{ route($dashboardRoute) }}" class="text-dark">Home</a></li>
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
            {{-- THIS IS THE CRITICAL CONTENT YIELD (YOUR "CANVAS") --}}
            @yield('content') 
        </div>
    </div>
    <!-- /.content -->
</main>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">
        Version 4.0.0-rc4
    </div>
    <strong>Copyright &copy; 2014-2025 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE-4.0.0-rc4/dist/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>