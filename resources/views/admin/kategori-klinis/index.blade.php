@extends('layouts.app')
@section('title', 'Daftar Kategori Klinis')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manajemen Kategori Klinis</h1>
        <p>Kelola kategori yang digunakan untuk keperluan klinis dan rekam medis.</p>
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
        <a href="{{ route('admin.kategori-klinis.create') }}" class="add-btn">Tambah Kategori Klinis</a>
    </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoriKlinis as $item)
                <tr>
                    <td>{{ $item->idkategori_klinis }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                    <td class="action-buttons">
                        {{-- Button Edit --}}
                        <a href="{{ route('admin.kategori-klinis.edit', $item->idkategori_klinis) }}" class="edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        {{-- Form Delete --}}
                        <form action="{{ route('admin.kategori-klinis.destroy', $item->idkategori_klinis) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori klinis {{ $item->nama_kategori_klinis }}? Tindakan ini tidak dapat dibatalkan jika masih ada relasi data.')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data kategori klinis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection