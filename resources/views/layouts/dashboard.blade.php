<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>RSHP Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
                    <li><a href="{{ route('admin.roles.index') }}">Manajemen Role</a></li>
                    <li><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
                    <li><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
                    <li><a href="{{ route('admin.kategori-hewan.index') }}">Kategori Hewan</a></li>
                    <li><a href="{{ route('admin.kategori-klinis.index') }}">Kategori Klinis</a></li>
                    <li><a href="{{ route('admin.pemilik.index') }}">Manajemen Pemilik</a></li>
                    <li><a href="{{ route('admin.pets.index') }}">Manajemen Pasien</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="main-content-area">
            <header class="main-header">
                <h1>{{ $title ?? 'Dashboard' }}</h1>
            </header>

            <main class="content-body">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>