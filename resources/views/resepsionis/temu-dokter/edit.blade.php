@extends('layouts.app')

@section('title', 'Edit Janji Temu Dokter')

@section('content-header', 'Edit Janji Temu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Janji Temu</h3>
                    <div class="card-tools">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('resepsionis.temu-dokter.update', $appointment['idreservasi_dokter']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idpet">Pilih Pet (Pasien)</label>
                            <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Pet --</option>
                                @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}" {{ $pet->idpet == $appointment['idpet'] ? 'selected' : '' }}>
                                    {{ $pet->nama }} ({{ $pet->rasHewan->nama_ras ?? 'N/A' }}) - Pemilik: {{ $pet->pemilik->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('idpet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="idrole_user_dokter">Pilih Dokter</label>
                            <select name="idrole_user_dokter" id="idrole_user_dokter" class="form-control @error('idrole_user_dokter') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($doctors as $doctor)
                                <option value="{{ $doctor->idrole_user }}" {{ $doctor->idrole_user == $appointment['idrole_user'] ? 'selected' : '' }}>
                                    {{ $doctor->user->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('idrole_user_dokter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
