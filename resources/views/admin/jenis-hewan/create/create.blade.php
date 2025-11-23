@extends('layouts.app')

@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="page-container">
    <div class="form-container">
        <h1>Tambah Jenis Hewan Baru</h1>

        <a href="{{ route('admin.jenis-hewan.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Jenis Hewan
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

        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="form-group">
                <label for="nama_jenis">Nama Jenis Hewan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                    value="{{ old('nama_jenis') }}" placeholder="Masukkan nama jenis hewan"
                    required>
                @error('nama_jenis') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-plus-circle"></i> Tambah Jenis Hewan
            </button>
        </form>
    </div>
</div>
@endsection
