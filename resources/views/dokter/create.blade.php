@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('dokter.pets.index') }}" class="back-link">← Kembali ke Daftar Pet</a>
    <div class="form-container">
        <h1>Tambah Data Pet (Pasien) Baru</h1>

        <form action="{{ route('dokter.pets.store') }}" method="POST">
            @csrf
            @include('dokter.pets._form', ['pet' => new \App\Models\Pet])
            <button type="submit" class="btn-submit">Simpan Data Pet</button>
        </form>
    </div>
</div>
@endsection