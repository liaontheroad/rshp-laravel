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
        <h1>Data Hewan Peliharaan Saya</h1>
        <p>Berikut adalah daftar hewan peliharaan yang terdaftar atas nama Anda.</p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peliharaan</th>
                <th>Jenis Hewan</th>
                <th>Ras</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pets as $pet)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pet->nama_pet }}</td>
                    <td>{{ $pet->rasHewan->jenis->nama_jenis_hewan ?? 'N/A' }}</td>
                    <td>{{ $pet->rasHewan->nama_ras_hewan ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Anda belum memiliki data hewan peliharaan yang terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection