@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Edit Ras Hewan')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Edit Ras Hewan')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card card-info card-outline"> {{-- Menggunakan card-info untuk warna edit --}}
            <div class="card-header">
                <h3 class="card-title">Form Edit Ras Hewan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Flash Message --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                {{-- Global Validation Errors (jika ada) --}}
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
                <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Field: Nama Ras Hewan --}}
                    <div class="mb-3"> 
                        <label for="nama_ras" class="form-label">Nama Ras Hewan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_ras') is-invalid @enderror"
                            id="nama_ras" name="nama_ras"
                            value="{{ old('nama_ras', $rasHewan->nama_ras) }}"
                            placeholder="Masukkan nama ras hewan" required>
                        @error('nama_ras') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    {{-- Field: Jenis Hewan (Dropdown) --}}
                    {{-- ASUMSI: Controller menyediakan variabel $jenisHewan (plural) yang berisi daftar semua Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                        <select id="idjenis_hewan" name="idjenis_hewan" class="form-select @error('idjenis_hewan') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @isset($jenisHewan)
                                @foreach ($jenisHewan as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}" 
                                        {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis_hewan }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('idjenis_hewan') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success mt-3">
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