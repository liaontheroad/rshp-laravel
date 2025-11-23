@extends('layouts.app')

@section('title', 'Edit Ras Hewan')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Edit Ras Hewan</h1>

        <a href="{{ route('admin.ras-hewan.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ras Hewan
        </a>

        @if (session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form untuk Submit Data --}}
        <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_ras">Nama Ras Hewan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_ras') is-invalid @enderror"
                    id="nama_ras" name="nama_ras"
                    value="{{ old('nama_ras', $rasHewan->nama_ras) }}"
                    placeholder="Masukkan nama ras hewan" required>
                @error('nama_ras') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection