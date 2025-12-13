@extends('layouts.app')

@section('title', 'Edit User')
@section('content-header', 'Edit User')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card card-info card-outline"> {{-- Menggunakan card-info untuk operasi Edit (biru) --}}
            <div class="card-header">
                <h3 class="card-title">Edit Pengguna: **{{ $user->name ?? $user->nama }}**</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-default" title="Kembali">
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
                
                {{-- Form untuk Submit Data --}}
                <form action="{{ route('admin.users.update', $user->iduser) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name ?? $user->nama) }}"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                        @error('name')
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
                            value="{{ old('email', $user->email) }}"
                            placeholder="Masukkan alamat email"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="idrole" class="form-label">Role/Jabatan <span class="text-danger">*</span></label>
                        {{-- Asumsi variabel $roles tersedia dari Controller --}}
                        <select id="idrole" name="idrole" class="form-select @error('idrole') is-invalid @enderror" required>
                            <option value="">-- Pilih Role --</option>
                            @isset($roles)
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->idrole }}"
                                        {{ old('idrole', $user->roles->first()->idrole ?? null) == $role->idrole ? 'selected' : '' }}
                                    >
                                        {{ $role->nama_role }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('idrole')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- Kotak Info untuk Password --}}
                    <div class="alert alert-warning mb-4 p-3 border border-warning">
                        <h5 class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-2"></i> Ubah Password</h5>
                        <p class="mb-0">Kosongkan field di bawah jika Anda **tidak** ingin mengganti password user ini.</p>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            {{-- Field ini TIDAK required karena ini adalah halaman EDIT --}}
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                        >
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> {{-- Tombol submit berwarna biru --}}
                            <i class="fas fa-save"></i> Perbarui User
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