<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>RSHP UNAIR | @yield('title', 'Dashboard')</title>
    {{-- ... other meta tags ... --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/css/adminlte.min.css') }}">

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
             <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                         <i class="fa-solid fa-bars" style="color: black !important;"></i>
                    </a>
                </ul>
                <ul class="navbar-nav ms-auto">
                <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('AdminLTE-4.0.0-rc4/dist/assets/img/user2-160x160.jpg') }}" class="user-image img-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </a>
                      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> 
                            <!-- User image -->
                            <li class="user-header bg-primary">
                            {{-- ... user image content ... --}}
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                
                                {{-- LOGOUT BUTTON AND FORM --}}
                                <a class="btn btn-default btn-flat float-end" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
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
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('AdminLTE-4.0.0-rc4/dist/assets/img/AdminLTELogo.png') }}" alt="RSHP Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RSHP Admin</span>
        </a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">

                {{-- ================================================= --}}
                {{--                      ADMIN MENU (role_id == 1)      --}}
                {{-- ================================================= --}}
                @if(session('user_role') == 1)
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
                        <li class="nav-item"><a href="{{ route('admin.dokter.index') }}" class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-md"></i><p>Data Dokter</p></a></li>

                        <li class="nav-header">MANAJEMEN PASIEN</li>
                        <li class="nav-item"><a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.*') ? 'active' : '' }}"><i class="nav-icon fas fa-heartbeat"></i><p>Data Pasien (Hewan)</p></a></li>
                    </ul>
                 @endif

                {{-- ================================================= --}}
                {{--                      DOKTER MENU (role_id == 2)     --}}
                {{-- ================================================= --}}
                @if(session('user_role') == 2)
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
                @endif
        </nav>
    </div>
    <!-- /.sidebar -->
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
                            {{-- BREADCRUMBS RESTORED --}}
                            <ol class="breadcrumb float-sm-end text-dark"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark">Home</a></li>
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

    </div>
    <script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-4.0.0-rc4/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-4.0.0-rc4/dist/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>