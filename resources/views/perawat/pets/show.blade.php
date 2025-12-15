@extends('layouts.admin')

@section('title', 'Detail Pasien')

@section('content-header', 'Detail Pasien')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pasien: {{ $pet->nama_hewan }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('perawat.pets.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID Pasien</dt>
                        <dd class="col-sm-9">{{ $pet->idpet }}</dd>

                        <dt class="col-sm-3">Nama Hewan</dt>
                        <dd class="col-sm-9">{{ $pet->nama_hewan }}</dd>

                        <dt class="col-sm-3">Jenis Hewan</dt>
                        <dd class="col-sm-9">{{ $pet->jenisHewan->nama_jenis ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Ras Hewan</dt>
                        <dd class="col-sm-9">{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Tanggal Lahir</dt>
                        <dd class="col-sm-9">{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') : 'N/A' }}</dd>

                        <dt class="col-sm-3">Jenis Kelamin</dt>
                        <dd class="col-sm-9">{{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}</dd>

                        <dt class="col-sm-3">Warna</dt>
                        <dd class="col-sm-9">{{ $pet->warna ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Pemilik</dt>
                        <dd class="col-sm-9">{{ $pet->pemilik->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Alamat Pemilik</dt>
                        <dd class="col-sm-9">{{ $pet->pemilik->alamat ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">No. Telepon</dt>
                        <dd class="col-sm-9">{{ $pet->pemilik->no_telepon ?? 'N/A' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
