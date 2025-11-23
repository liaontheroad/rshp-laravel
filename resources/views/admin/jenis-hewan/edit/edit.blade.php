@extends('layouts.app')

@section('title', 'Edit Jenis Hewan')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Edit Jenis Hewan</h1>

        <a href="{{ route('admin.jenis-hewan.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Jenis Hewan
        </a>

        @if (session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form untuk Submit Data --}}
        <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_jenis">Nama Jenis Hewan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                    id="nama_jenis" name="nama_jenis"
                    value="{{ old('nama_jenis', $jenisHewan->nama_jenis) }}"
                    placeholder="Masukkan nama jenis hewan" required>

                @error('nama_jenis')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
