@extends('layouts.app')

@section('title', 'Tambah Kategori ')

@section('content')
    <div class="page-container">
        <div class="form-container">
            <h1>Tambah Kategori </h1>

            <a href="{{ route('admin.kategori.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kategori
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

            <form action="{{ route('admin.kategori.store') }}" method="POST" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori Hewan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori " required>
                    @error('nama_kategori') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus-circle"></i> Tambah Kategori
                </button>
            </form>
        </div>
    </div>
@endsection