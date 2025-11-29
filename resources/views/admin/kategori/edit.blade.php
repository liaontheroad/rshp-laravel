@extends('layouts.app')

@section('title', 'Edit Kategori Hewan')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Edit Kategori Hewan</h1>
        
        <a href="{{ route('admin.kategori.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kategori
        </a>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.kategori.update', ['kategori' => $kategori->idkategori]) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori Hewan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan nama kategori"
                    required>
                @error('nama_kategori') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection