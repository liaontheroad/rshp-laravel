@extends('layouts.app')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #6588e8, #4a6fc4);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .page-header h1 { margin: 0; font-size: 28px; }
    .page-header p { margin: 10px 0 0 0; opacity: 0.9; }
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
    }
    .data-table th, .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    .data-table thead tr {
        background-color: #f2f2f2;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Manajemen Janji Temu Dokter</h1>
        <p>Daftar janji temu untuk hari ini.</p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No. Urut</th>
                <th>Waktu Daftar</th>
                <th>Nama Pet</th>
                <th>Pemilik</th>
                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftarans as $pendaftaran)
                <tr>
                    <td>{{ $pendaftaran['no_urut'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($pendaftaran['waktu_daftar'])->format('d M Y, H:i') }}</td>
                    <td>{{ $pendaftaran['nama_pet'] }}</td>
                    <td>{{ $pendaftaran['nama_pemilik'] }}</td>
                    <td>{{ $pendaftaran['nama_dokter'] }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada janji temu untuk hari ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
