@extends('layouts.app')

@section('title', 'Edit Role')
@section('content-header', 'Edit Role')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card card-info card-outline"> {{-- Menggunakan card-info untuk warna edit (biru) --}}
            <div class="card-header">
                <h3 class="card-title">Form Edit Role: **{{ $role->nama_role }}**</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Global Flash Message (Error dari session('error')) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
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
                <form action="{{ route('admin.roles.update', $role->idrole) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    
                    {{-- Field: Nama Role --}}
                    <div class="mb-3"> 
                        <label for="nama_role" class="form-label">Nama Role <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama_role') is-invalid @enderror"
                            id="nama_role"
                            name="nama_role"
                            value="{{ old('nama_role', $role->nama_role) }}"
                            placeholder="Contoh: Dokter, Perawat, Resepsionis"
                            required
                        >
                        @error('nama_role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> 
                            <i class="fas fa-save"></i> Perbarui Role
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