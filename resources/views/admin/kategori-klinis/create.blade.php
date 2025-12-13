@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Tambah Kategori Klinis')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Tambah Kategori Klinis Baru')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card card-success card-outline"> {{-- Menggunakan card-success untuk operasi Tambah (hijau) --}}
            <div class="card-header">
                <h3 class="card-title">Isi Data Kategori Klinis</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-sm btn-default" title="Kembali">
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
                <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                    @csrf
                    
                    {{-- Field: Nama Kategori Klinis --}}
                    <div class="mb-3"> 
                        <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                            id="nama_kategori_klinis"
                            name="nama_kategori_klinis"
                            value="{{ old('nama_kategori_klinis') }}"
                            placeholder="Masukkan nama kategori klinis"
                            required
                        >
                        
                        {{-- Field Specific Error Feedback --}}
                        @error('nama_kategori_klinis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> {{-- Tombol submit berwarna hijau --}}
                            <i class="fas fa-save"></i> Simpan
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