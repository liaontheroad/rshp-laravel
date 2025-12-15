@extends('layouts.app')

@section('title', 'Edit Data Pemilik')
@section('content-header', 'Edit Data Pemilik')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-8 col-md-10 col-sm-12">
        
        {{-- Card Utama untuk Form --}}
        <div class="card card-info card-outline"> 
            <div class="card-header">
                <h3 class="card-title">Form Edit Pemilik: **{{ $pemilik->user->name ?? $pemilik->user->nama }}**</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-sm btn-default" title="Kembali">
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
                <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    
                    {{-- =================================== --}}
                    <h5 class="mt-3 mb-3 pb-2 border-bottom text-primary">Data Akun & User</h5>
                    {{-- =================================== --}}
                    
                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            name="nama"
                            {{-- Menggunakan $pemilik->user->name jika ada, fallback ke $pemilik->user->nama --}}
                            value="{{ old('nama', $pemilik->user->name ?? $pemilik->user->nama) }}"
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
                            value="{{ old('email', $pemilik->user->email) }}"
                            placeholder="Masukkan alamat email aktif"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    {{-- =================================== --}}
                    <h5 class="mt-4 mb-3 pb-2 border-bottom text-primary">Data Profil Pemilik</h5>
                    {{-- =================================== --}}

                    {{-- Nomor WhatsApp --}}
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('no_wa') is-invalid @enderror"
                            id="no_wa"
                            name="no_wa"
                            value="{{ old('no_wa', $pemilik->no_wa) }}"
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
                        >{{ old('alamat', $pemilik->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> {{-- Tombol submit berwarna biru --}}
                            <i class="fas fa-save"></i> Perbarui Data Pemilik
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