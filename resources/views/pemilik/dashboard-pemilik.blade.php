@extends('layouts.app')

@section('title', 'Dashboard Pemilik')

@section('content-header', 'Dashboard Pemilik')

@section('content')
    <div class="row">
         <h1>Selamat Datang, {{ session('user_name', 'Pemilik') }}!</h1>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Pemilik') }}</strong>. Silakan kelola data peliharaan Anda melalui menu di bawah ini.</p>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="dashboard-grid">
                        <a href="{{ route('pemilik.pets.index') }}" class="dashboard-card">
                            <h3><i class="fas fa-paw"></i> Data Peliharaan Saya</h3>
                            <p>Lihat riwayat dan data hewan peliharaan Anda.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
