@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Tambah Kategori')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Tambah Kategori Penanganan Pasien Baru')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card card-success card-outline"> {{-- Menggunakan card-success untuk operasi Tambah --}}
            <div class="card-header">
                <h3 class="card-title">Isi Data Kategori</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Global Error Message --}}
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
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-3"> {{-- Menggunakan mb-3 untuk spacing --}}
                        <label for="nama_kategori" class="form-label">Nama Kategori Penanganan <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('nama_kategori') is-invalid @enderror" 
                            id="nama_kategori" 
                            name="nama_kategori"
                            value="{{ old('nama_kategori') }}" 
                            placeholder="Masukkan nama kategori"
                            required>
                        
                        {{-- Field Specific Error Feedback --}}
                        @error('nama_kategori') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle"></i> Tambah Kategori
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