@extends('layouts.app')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Tambah Ras Hewan Baru</h1>

        <a href="{{ route('admin.ras-hewan.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ras Hewan
        </a>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.ras-hewan.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="form-group">
                <label for="nama_ras">Nama Ras Hewan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ras" name="nama_ras"
                    value="{{ old('nama_ras') }}" placeholder="Masukkan nama ras hewan" required>
                @error('nama_ras') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-plus-circle"></i> Tambah Ras Hewan
            </button>
        </form>
    </div>
</div>
@endsection