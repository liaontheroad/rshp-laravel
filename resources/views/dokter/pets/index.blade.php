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
    .data-table th { background-color: #6588e8; color: white; text-transform: uppercase; font-size: 14px; }
    .data-table tr:hover { background-color: #f5f5f5; }
    .add-btn { background-color: #2ecc71; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-decoration: none; display: inline-block; margin-bottom: 20px; transition: background-color 0.3s; }
    .add-btn:hover { background-color: #27ae60; }
    .action-buttons a, .action-buttons button { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; font-size: 14px; font-weight: bold; margin-right: 5px; border: none; cursor: pointer; }
    .edit-btn { background-color: #f1c40f; color: black; }
    .delete-btn { background-color: #e74c3c; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Manajemen Data Pet (Pasien)</h1>
        <p>Kelola data semua pet yang terdaftar sebagai pasien di RSHP.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('dokter.pets.create') }}" class="add-btn">Tambah Data Pet</a>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pet</th>
                <th>Jenis Hewan</th>
                <th>Ras</th>
                <th>Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pets as $pet)
                <tr>
                    <td>{{ $pet->idpet }}</td>
                    <td>{{ $pet->nama }}</td>
                    <td>{{ $pet->ras->jenis->nama_jenis_hewan ?? 'N/A' }}</td>
                    <td>{{ $pet->ras->nama_ras ?? 'N/A' }}</td>
                    <td>{{ $pet->pemilik->user->nama ?? 'N/A' }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('dokter.pets.edit', $pet->idpet) }}" class="edit-btn">Edit</a>
                        <form action="{{ route('dokter.pets.destroy', $pet->idpet) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pet ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center;">Belum ada data pet (pasien).</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection