@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Manajemen Data Pemilik')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Manajemen Data Pemilik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Pemilik Hewan Peliharaan</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Tambah Pemilik
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
                                <th style="width: 20%">Nama Pemilik</th>
                                <th style="width: 10%">Nomor HP</th>
                                <th style="width: 20%">Email</th>
                                <th style="width: 25%">Alamat</th>
                                <th style="width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemilikList as $item)
                            <tr>
                                <td>{{ $item->idpemilik }}</td>
                                {{-- Menggunakan relasi user --}}
                                <td>{{ $item->user->name ?? $item->user->nama ?? 'N/A' }}</td> 
                                <td>{{ $item->no_wa }}</td>
                                <td>{{ $item->user->email ?? '-' }}</td>
                                {{-- Menggunakan Str::limit dari Laravel untuk alamat panjang --}}
                                <td>{{ Str::limit($item->alamat, 50) }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('resepsionis.pemilik.edit', $item->idpemilik) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('resepsionis.pemilik.destroy', $item->idpemilik) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pemilik {{ $item->user->name ?? $item->user->nama ?? 'ini' }}? Tindakan ini tidak dapat dibatalkan.');" style="display:inline;">
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
                                <td colspan="6" class="text-center text-muted">Tidak ada data pemilik yang terdaftar.</td>
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