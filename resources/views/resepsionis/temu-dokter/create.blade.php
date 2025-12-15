@extends('layouts.app')

@section('title', 'Tambah Janji Temu Dokter')

@section('content-header', 'Tambah Janji Temu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulir Janji Temu Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idpet">Pilih Pet (Pasien)</label>
                            <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Pet --</option>
                                @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}">{{ $pet->nama }} ({{ $pet->rasHewan->nama_ras ?? 'N/A' }}) - Pemilik: {{ $pet->pemilik->nama }}</option>
                                @endforeach
                            </select>
                            @error('idpet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="idrole_user">Pilih Dokter</label>
                            <select name="idrole_user" id="idrole_user" class="form-control @error('idrole_user') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($doctors as $doctor)
                                <option value="{{ $doctor->idrole_user }}">{{ $doctor->user->nama }}</option>
                                @endforeach
                            </select>
                            @error('idrole_user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Janji Temu
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
