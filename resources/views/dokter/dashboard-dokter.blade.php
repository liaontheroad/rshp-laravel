@extends('layouts.app')

@section('content')
{{-- Membungkus sidebar dan konten utama dalam satu div dengan layout Flexbox untuk tampilan dua kolom.
     Kelas 'dashboard-container' digunakan kembali untuk properti max-width dan centering dari layouts/app.blade.php,
     dan ditambahkan inline style untuk membuat tata letak fleksibel. --}}
<div class="dashboard-container" style="display: flex; gap: 30px; align-items: flex-start;">
    
    {{-- Kolom Sidebar --}}
    <aside style="flex: 0 0 280px; max-width: 280px;">
        @include('components.side-bar')
    </aside>

    {{-- Kolom Konten Utama (Konten Dashboard Awal) --}}
    <main style="flex: 1; min-width: 0;">
        <div class="main-dashboard-content">
            <div class="welcome-section">
                <h1>Selamat Datang, {{ session('user_name', 'Admin') }}!</h1>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Administrator') }}</strong>. Silakan kelola data master melalui menu di bawah ini.</p>
                <a href="{{ route('logout') }}" class="btn-dashboard btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form-dashboard').submit();">
                    Logout
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endifai

            <div class="dashboard-grid">
                {{-- Kartu menu untuk Dokter bisa ditambahkan di sini --}}
            </div>

            <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @include('components.footer')
    </div>
</div>
@endsection