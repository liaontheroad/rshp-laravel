@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Selamat Datang, {{ session('user_name', 'Admin') }}!</h4>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form-dashboard').submit();">
                        Logout
                    </a>
                </div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p>Anda login sebagai <strong>{{ session('user_role_name', 'Administrator') }}</strong>. Silakan kelola data master melalui menu di bawah ini.</p>

                    <hr>

                    <h5><i class="fas fa-database"></i> Data Master</h5>
                    <div class="row mt-3">
                        <!-- Master Data Hewan -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-outline-primary btn-block w-100">Jenis Hewan</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-outline-primary btn-block w-100">Ras Hewan</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.kategori_hewan.index') }}" class="btn btn-outline-primary btn-block w-100">Kategori Hewan</a>
                        </div>

                        <!-- Master Data Klinis -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-outline-secondary btn-block w-100">Kategori Klinis</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.kode_tindakan_terapi.index') }}" class="btn btn-outline-secondary btn-block w-100">Kode Tindakan Terapi</a>
                        </div>

                        <!-- Master Data Pengguna & Pasien -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success btn-block w-100">Manajemen User</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-success btn-block w-100">Manajemen Role</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-outline-info btn-block w-100">Data Pemilik</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.pets.index') }}" class="btn btn-outline-info btn-block w-100">Data Pasien (Pets)</a>
                        </div>
                    </div>
                </div>

                <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection