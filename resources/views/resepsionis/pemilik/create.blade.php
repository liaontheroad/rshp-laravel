@extends('layouts.app')

@section('title', 'Tambah Data Pemilik')
@section('content-header', 'Tambah Data Pemilik Baru')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-8 col-md-10 col-sm-12">
        
        {{-- Card Utama untuk Form --}}
        <div class="card card-success card-outline"> 
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data Pemilik</h3>
                <div class="card-tools">
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Global Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- Flash Message (Error dari session('error')) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                {{-- Form untuk Submit Data --}}
                <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
                    @csrf

                    
                    {{-- =================================== --}}
                    <h5 class="mt-3 mb-3 pb-2 border-bottom text-success">Data Akun & Login</h5>
                    {{-- =================================== --}}
                    
                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap pemilik"
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan alamat email aktif"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Masukkan password (minimal 6 karakter)"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    {{-- =================================== --}}
                    <h5 class="mt-4 mb-3 pb-2 border-bottom text-success">Data Profil Pemilik</h5>
                    {{-- =================================== --}}

                    {{-- Nomor WhatsApp --}}
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('no_wa') is-invalid @enderror"
                            id="no_wa"
                            name="no_wa"
                            value="{{ old('no_wa') }}"
                            placeholder="Masukkan nomor WhatsApp aktif"
                            required
                        >
                        @error('no_wa')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            class="form-control @error('alamat') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan alamat lengkap pemilik"
                            required
                        >{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> {{-- Tombol submit berwarna hijau --}}
                            <i class="fas fa-save"></i> Simpan Data Pemilik
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection