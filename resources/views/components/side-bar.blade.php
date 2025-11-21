<div class="sidebar w-64 min-h-screen flex flex-col @if(session('user_role') == 1) bg-blue-100 @elseif(session('user_role') == 2) bg-green-100 @elseif(session('user_role') == 3) bg-yellow-100 @elseif(session('user_role') == 4) bg-purple-100 @elseif(session('user_role') == 5) bg-pink-100 @else bg-gray-100 @endif">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 flex items-center gap-2">
        <div class="w-8 h-8 bg-[#FFB800] rounded-lg flex items-center justify-center">
            <i class="fas fa-paw text-white"></i>
        </div>
        <h2 class="font-bold text-gray-800">RSHP UNAIR</h2>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li><a href="{{ route('home') }}" class="sidebar-link">Home</a></li>

            {{-- Admin (Role ID 1) --}}
            @if(session('user_role') == 1)
                <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link">Admin Dashboard</a></li>
            @endif

            {{-- Dokter (Role ID 2) --}}
            @if(session('user_role') == 2)
                <li><a href="{{ route('dokter.dashboard') }}" class="sidebar-link">Dokter Dashboard</a></li>
                {{-- <li><a href="#" class="sidebar-link">Jadwal Saya</a></li> --}}
            @endif

            {{-- Perawat (Role ID 3) --}}
            @if(session('user_role') == 3)
                <li><a href="{{ route('perawat.dashboard') }}" class="sidebar-link">Perawat Dashboard</a></li>
                {{-- <li><a href="#" class="sidebar-link">Data Pasien</a></li> --}}
            @endif

            {{-- Resepsionis (Role ID 4) --}}
            @if(session('user_role') == 4)
                <li><a href="{{ route('resepsionis.dashboard') }}" class="sidebar-link">Resepsionis Dashboard</a></li>
                <li><a href="{{ route('resepsionis.pendaftaran') }}" class="sidebar-link">Pendaftaran</a></li>
            @endif

            {{-- Pemilik (Role ID 5) --}}
            @if(session('user_role') == 5)
                <li><a href="{{ route('pemilik.dashboard') }}" class="sidebar-link">Pemilik Dashboard</a></li>
                {{-- <li><a href="{{ route('pemilik.pets.index') }}" class="sidebar-link">Peliharaan Saya</a></li> --}}
            @endif
        </ul>
    </nav>
</div>