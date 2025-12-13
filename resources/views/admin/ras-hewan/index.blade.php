@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Daftar Ras Hewan')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Manajemen Ras Hewan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Ras Hewan</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Tambah Ras Hewan
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
                                <th style="width: 5%">ID</th>
                                <th>Nama Ras</th>
                                <th>Jenis Hewan</th>
                                <th style="width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rasHewan as $ras)
                            <tr>
                                <td>{{ $ras->idras_hewan }}</td>
                                <td>{{ $ras->nama_ras }}</td>
                                {{-- Menampilkan nama jenis hewan yang terkait --}}
                                <td>{{ $ras->jenis->nama_jenis_hewan ?? 'N/A' }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Link Hapus (Delete Form) --}}
                                    <form action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ras {{ $ras->nama_ras }}? Tindakan ini tidak dapat dibatalkan.');" style="display:inline;">
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
                                <td colspan="4" class="text-center text-muted">Tidak ada data ras hewan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Kembali di bawah tabel (Opsional, karena sudah ada di header) --}}
                {{-- <div class="mt-3">
                    <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection