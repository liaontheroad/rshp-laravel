@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Edit Jenis Hewan')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Edit Jenis Hewan')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12"> {{-- Membatasi lebar form --}}
        <div class="card card-info card-outline"> {{-- Menggunakan card-info untuk warna biru --}}
            <div class="card-header">
                <h3 class="card-title">Form Edit Data</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Flash Message (menggunakan Bootstrap Alert dan dismissible) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form untuk Submit Data --}}
                <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3"> {{-- Mengganti form-group dengan mb-3 (margin bottom) --}}
                        <label for="nama_jenis" class="form-label">Nama Jenis Hewan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                            id="nama_jenis" 
                            name="nama_jenis"
                            {{-- Saya asumsikan nama field model adalah 'nama_jenis_hewan' berdasarkan file index --}}
                            value="{{ old('nama_jenis', $jenisHewan->nama_jenis_hewan ?? $jenisHewan->nama_jenis) }}"
                            placeholder="Masukkan nama jenis hewan" 
                            required>

                        @error('nama_jenis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2"> {{-- Menggunakan d-grid untuk tombol lebar penuh --}}
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save"></i> Simpan Perubahan
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