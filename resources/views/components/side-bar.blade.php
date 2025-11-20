<div class="card">
    <div class="card-header">
        Menu Navigasi
    </div>
    <div class="card-body">
        <ul class="nav flex-column">

            {{-- Generic/All Roles Links --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            {{-- Admin (Role ID 1) --}}
            @if(session('user_role') == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                </li>
                {{-- Add other admin-specific links here --}}
                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a></li> --}}
            @endif

            {{-- Dokter (Role ID 2) --}}
            @if(session('user_role') == 2)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dokter.dashboard') }}">Dokter Dashboard</a>
                </li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Jadwal Saya</a></li> --}}
            @endif

            {{-- Perawat (Role ID 3) --}}
            @if(session('user_role') == 3)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('perawat.dashboard') }}">Perawat Dashboard</a>
                </li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Data Pasien</a></li> --}}
            @endif

            {{-- Resepsionis (Role ID 4) --}}
            @if(session('user_role') == 4)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('resepsionis.dashboard') }}">Resepsionis Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('resepsionis.pendaftaran') }}">Pendaftaran</a>
                </li>
            @endif

            {{-- Pemilik (Role ID 5) --}}
            @if(session('user_role') == 5)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.dashboard') }}">Pemilik Dashboard</a>
                </li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('pemilik.pets.index') }}">Peliharaan Saya</a></li> --}}
            @endif
        </ul>
    </div>
</div>