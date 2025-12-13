@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Edit Kode Tindakan/Terapi')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Edit Kode Tindakan/Terapi')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card card-info card-outline"> {{-- Menggunakan card-info untuk warna edit (biru) --}}
            <div class="card-header">
                <h3 class="card-title">Form Edit Kode Tindakan/Terapi: **{{ $kodeTindakanTerapi->kode }}**</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Flash Message (Error dari session('error')) --}}
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
                <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    
                    {{-- Form Group: Kode --}}
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Tindakan/Terapi <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('kode') is-invalid @enderror"
                            id="kode"
                            name="kode"
                            value="{{ old('kode', $kodeTindakanTerapi->kode) }}"
                            placeholder="Contoh: RX001"
                            required
                        >
                        @error('kode')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Form Group: Kategori Hewan --}}
                    <div class="mb-3">
                        <label for="idkategori" class="form-label">Kategori Hewan <span class="text-danger">*</span></label>
                        {{-- Pastikan variabel $kategori tersedia dari controller --}}
                        <select id="idkategori" name="idkategori" class="form-select @error('idkategori') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori Hewan --</option>
                            @isset($kategori)
                                @foreach ($kategori as $item)
                                    <option 
                                        value="{{ $item->idkategori }}" 
                                        {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $item->idkategori ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('idkategori')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Form Group: Kategori Klinis --}}
                    <div class="mb-3">
                        <label for="idkategori_klinis" class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                        {{-- Pastikan variabel $kategoriKlinis tersedia dari controller --}}
                        <select id="idkategori_klinis" name="idkategori_klinis" class="form-select @error('idkategori_klinis') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @isset($kategoriKlinis)
                                @foreach ($kategoriKlinis as $item)
                                    <option 
                                        value="{{ $item->idkategori_klinis }}" 
                                        {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $item->idkategori_klinis ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('idkategori_klinis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Form Group: Deskripsi (Textarea) --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Tindakan <span class="text-danger">*</span></label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            rows="3"
                            placeholder="Jelaskan secara singkat tindakan/terapi ini"
                            required
                        >{{ old('deskripsi', $kodeTindakanTerapi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> 
                            <i class="fas fa-save"></i> Perbarui Kode
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