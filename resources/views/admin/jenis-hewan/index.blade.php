@extends('layouts.app') 

@section('title', 'Daftar Jenis Hewan')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Manajemen Jenis Hewan</h1>
        <p>Kelola data master untuk kategori utama hewan.</p>
    </div>

    <div class="main-content">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
    @endif

    {{-- Baris Tombol Aksi --}}
    <div class="action-bar">
        {{-- Tombol Kembali menggunakan JavaScript --}}
        <button type="button" onclick="history.back()" class="back-btn">Kembali</button>
        <a href="{{ route('admin.jenis-hewan.create') }}" class="add-btn">Tambah Jenis Hewan</a>
    </div>

    {{-- Tabel Data --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis Hewan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop untuk menampilkan data dari Controller --}}
            @foreach ($jenisHewan as $index => $hewan)
            <tr>
                {{-- Nomor Urut (index + 1) --}}
                <td>{{ $index + 1 }}</td> 
                
                {{-- Nama Jenis Hewan --}}
                <td>{{ $hewan->nama_jenis_hewan }}</td>
                
                {{-- Kolom Aksi --}}
                <td class="action-buttons">
                    {{-- Link Edit --}}
                    <a href="{{ route('admin.jenis-hewan.edit', $hewan->idjenis_hewan) }}" class="edit-btn">
                        Edit
                    </a>
                    
                    {{-- Link Hapus (Delete Form) --}}
                    {{-- Anda akan menggunakan form POST untuk DELETE di Laravel --}}
                    <form action="{{ route('admin.jenis-hewan.destroy', $hewan->idjenis_hewan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus jenis hewan ini?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            
            @if ($jenisHewan->isEmpty())
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data jenis hewan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection