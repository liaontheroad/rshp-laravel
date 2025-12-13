@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Manajemen Kategori')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Manajemen Kategori')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Kategori Penanganan</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Tambah Kategori
                    </a>
                </div>
            </div>

            <div class="card-body">
                
                {{-- Flash Message (Success) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                {{-- Flash Message (Error) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Tabel Data --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">NO</th>
                                <th>Nama Kategori</th>
                                <th style="width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('admin.kategori.edit', $item->idkategori) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('admin.kategori.destroy', $item->idkategori) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $item->nama_kategori }}? Tindakan ini tidak dapat dibatalkan jika masih ada relasi data.');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Tidak ada data kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-3">
                    <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection