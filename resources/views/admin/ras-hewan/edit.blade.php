@extends('layouts.app')

@section('title', 'Edit Ras Hewan')

@section('content')
<div class="page-container">
    {{-- Menggunakan class form-container untuk styling terpusat --}}
    <div class="form-container">
        <h1>Edit Ras Hewan: {{ $rasHewan->nama_ras }}</h1>
        
        <a href="{{ route('admin.ras-hewan.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ras
        </a>

        {{-- Menampilkan pesan error atau success --}}
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
            @csrf
            @method('PUT') {{-- Gunakan metode PUT untuk update --}}

            {{-- Form Group: Nama Ras Hewan --}}
            <div class="form-group">
                <label for="nama_ras">Nama Ras Hewan <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="nama_ras"
                    name="nama_ras"
                    {{-- Menggunakan old() dengan fallback ke data model ($rasHewan->nama_ras) --}}
                    value="{{ old('nama_ras', $rasHewan->nama_ras) }}" 
                    placeholder="Masukkan nama ras hewan"
                    required
                >
                @error('nama_ras')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Form Group: Jenis Hewan --}}
            <div class="form-group">
                <label for="idjenis_hewan">Jenis Hewan <span class="text-danger">*</span></label>
                <select id="idjenis_hewan" name="idjenis_hewan" required>
                    <option value="">Pilih Jenis Hewan</option>
                    @foreach ($jenisHewan as $jenis)
                        <option 
                            value="{{ $jenis->idjenis_hewan }}" 
                            {{-- Memilih jenis hewan berdasarkan data model --}}
                            {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}
                        >
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
                @error('idjenis_hewan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Perbarui Data
            </button>
        </form>
    </div>
</div>
@endsection