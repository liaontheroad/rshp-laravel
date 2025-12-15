@extends('layouts.app')

@section('title', 'Tambah Data Pasien (Pet)')
@section('content-header', 'Tambah Data Pasien Baru')

@section('content')
<div class="row justify-content-center"> {{-- Pusatkan Card --}}
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card card-success card-outline"> {{-- Menggunakan card-success untuk operasi Tambah (hijau) --}}
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data Pasien</h3>
                <div class="card-tools">
                    <a href="{{ route('resepsionis.pets.index') }}" class="btn btn-sm btn-default" title="Kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Global Validation Errors / Flash Messages --}}
                @if ($errors->any() || session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        @if ($errors->any())
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @else
                            {{ session('error') }}
                        @endif
                    </div>
                @endif
                
                {{-- Form untuk Submit Data --}}
                <form action="{{ route('resepsionis.pets.store') }}" method="POST">
                    @csrf

                    {{-- Nama Pet --}}
                    <div class="mb-3">
                        <label for="nama_pet" class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama_pet') is-invalid @enderror"
                            id="nama_pet"
                            name="nama_pet"
                            value="{{ old('nama_pet') }}"
                            placeholder="Masukkan nama hewan"
                            required
                        >
                        @error('nama_pet')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pemilik --}}
                    <div class="mb-3">
                        <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
                        <select id="idpemilik" name="idpemilik" class="form-select @error('idpemilik') is-invalid @enderror" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @isset($pemilik)
                                @foreach ($pemilik as $item)
                                    <option 
                                        value="{{ $item['idpemilik'] }}" 
                                        {{ old('idpemilik') == $item['idpemilik'] ? 'selected' : '' }}>
                                        {{ $item['nama'] }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('idpemilik')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Jenis Hewan --}}
                            <div class="mb-3">
                                <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                                <select id="idjenis_hewan" name="idjenis_hewan" class="form-select @error('idjenis_hewan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    @isset($jenisHewan)
                                        @foreach ($jenisHewan as $item)
                                            <option 
                                                value="{{ $item['idjenis_hewan'] }}" 
                                                {{ old('idjenis_hewan') == $item['idjenis_hewan'] ? 'selected' : '' }}>
                                                {{ $item['nama_jenis_hewan'] }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('idjenis_hewan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Ras Hewan (Dropdown ini memerlukan JS untuk filter dinamis) --}}
                            <div class="mb-3">
                                <label for="idras_hewan" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
                                <select id="idras_hewan" name="idras_hewan" class="form-select @error('idras_hewan') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Hewan terlebih dahulu</option>
                                    {{-- Opsi Ras Hewan akan diisi/difilter oleh JavaScript --}}
                                    @isset($rasHewan)
                                        @foreach ($rasHewan as $ras)
                                            <option
                                                value="{{ $ras['idras_hewan'] }}"
                                                data-idjenis="{{ $ras['idjenis_hewan'] }}"
                                                class="ras-option"
                                                style="display:none;"
                                                {{ old('idras_hewan') == $ras['idras_hewan'] ? 'selected' : '' }}
                                            >
                                                {{ $ras['nama_ras'] }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('idras_hewan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- End Row --}}
                    
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Tanggal Lahir --}}
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir"
                                    name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}"
                                >
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Jenis Kelamin --}}
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    {{-- Menggunakan nilai J/B untuk database consistency --}}
                                    <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                                    <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- End Row --}}


                    {{-- Warna --}}
                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna / Tanda</label>
                        <input
                            type="text"
                            class="form-control @error('warna') is-invalid @enderror"
                            id="warna"
                            name="warna"
                            value="{{ old('warna') }}"
                            placeholder="Contoh: Coklat Putih"
                        >
                        @error('warna')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-3"> {{-- Tombol submit berwarna hijau --}}
                            <i class="fas fa-save"></i> Simpan Data Pasien
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

@push('scripts')
<script>
    function filterRas() {
        const jenisHewanId = document.getElementById('idjenis_hewan').value;
        const rasHewanSelect = document.getElementById('idras_hewan');
        // Ambil semua opsi yang memiliki class 'ras-option' (yang berisi data ras)
        const rasOptions = rasHewanSelect.querySelectorAll('.ras-option');
        
        // Simpan nilai Ras yang sedang terpilih saat ini
        const selectedRasId = rasHewanSelect.value;
        let foundCurrentRas = false;

        // Reset display
        rasOptions.forEach(option => {
            option.style.display = 'none';
            option.selected = false;
        });
        
        // Tampilkan placeholder jika tidak ada jenis yang dipilih
        if (!jenisHewanId) {
            rasHewanSelect.querySelector('option[value=""]').textContent = 'Pilih Jenis Hewan terlebih dahulu';
            rasHewanSelect.value = '';
            return;
        } else {
             rasHewanSelect.querySelector('option[value=""]').textContent = '-- Pilih Ras Hewan --';
        }


        // Tampilkan opsi yang sesuai dengan Jenis Hewan yang dipilih
        rasOptions.forEach(option => {
            if (option.dataset.idjenis == jenisHewanId) {
                option.style.display = '';
                
                // Cek apakah opsi ini adalah yang sebelumnya dipilih (untuk mempertahankan old())
                if (option.value == selectedRasId) {
                    option.selected = true;
                    foundCurrentRas = true;
                }
            }
        });

        // Jika Jenis Hewan berubah dan Ras yang terpilih sebelumnya bukan bagian dari jenis baru,
        // paksa reset pilihan Ras agar pengguna memilih ulang
        if (jenisHewanId && !foundCurrentRas) {
             rasHewanSelect.value = ''; // Reset to placeholder
        }
    }

    // Tambahkan event listener untuk perubahan pada dropdown Jenis Hewan
    document.addEventListener('DOMContentLoaded', function() {
        filterRas(); // Panggil saat DOM siap untuk inisialisasi old() value
        document.getElementById('idjenis_hewan').addEventListener('change', filterRas);
    });
</script>
@endpush