@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('dokter.pets.index') }}" class="back-link">← Kembali ke Daftar Pet</a>
    <div class="form-container">
        <h1>Edit Data Pet (Pasien)</h1>

        <form action="{{ route('dokter.pets.update', $pet->idpet) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dokter.pets._form')
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection