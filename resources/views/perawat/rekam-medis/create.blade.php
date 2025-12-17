@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content-header', 'Tambah Rekam Medis')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Rekam Medis</h3>
                </div>
                <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idpet">Pilih Hewan</label>
                            <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Hewan --</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                        {{ $pet->nama_hewan }} - {{ $pet->pemilik->nama ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="anamnesa">Anamnesa</label>
                            <textarea name="anamnesa" id="anamnesa" class="form-control @error('anamnesa') is-invalid @enderror" rows="3" required>{{ old('anamnesa') }}</textarea>
                            @error('anamnesa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="temuan_klinis">Temuan Klinis</label>
                            <textarea name="temuan_klinis" id="temuan_klinis" class="form-control @error('temuan_klinis') is-invalid @enderror" rows="3" required>{{ old('temuan_klinis') }}</textarea>
                            @error('temuan_klinis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diagnosa">Diagnosa</label>
                            <textarea name="diagnosa" id="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" rows="3" required>{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
