@extends('layouts.app')

@section('title', 'Profil Dokter')

@section('content-header', 'Profil Dokter')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Dokter</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row align-items-center">
                           {{-- KOLOM KIRI: FOTO DAN NAMA UTAMA --}}
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                {{-- URL GAMBAR SUDAH DIGANTI --}}
                                <img src="https://i.pinimg.com/736x/4e/b7/0b/4eb70b87e6b9be59a89f25f081dc2420.jpg"
                                    alt="Profile Picture"
                                    class="rounded-circle img-thumbnail mb-3 shadow"
                                    onerror="this.onerror=null; this.src='https://placehold.co/150x150/EEEEEE/333333?text=Profile';"> {{-- Menambahkan fallback --}}
                                    
                                <h4>{{ $dokter->user->nama ?? 'N/A' }}</h4>
                                <p class="text-muted mb-0">Dokter</p>
                            </div>

                            <div class="col-md-8">
                                <h5 class="mb-4 text-primary border-bottom pb-2">Informasi Pribadi</h5>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Nama Lengkap</label>
                                    <p class="fs-5">{{ $dokter->user->nama ?? 'N/A' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Alamat</label>
                                    <p class="fs-5">{{ $dokter->alamat ?? 'N/A' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-muted small text-uppercase">No. HP</label>
                                    <p class="fs-5">{{ $dokter->no_hp ?? 'N/A' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Jenis Kelamin</label>
                                    <p class="fs-5">{{ $dokter->jenis_kelamin ?? 'N/A' }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Pendidikan</label>
                                    <p class="fs-5">{{ $dokter->pendidikan ?? 'N/A' }}</p>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
