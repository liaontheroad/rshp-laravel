@extends('layouts.app')

@section('title', 'Manajemen Role (Jabatan)')
@section('content-header', 'Manajemen Role (Jabatan)')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Role Pengguna</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Tambah Role Baru
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
                                <th>Nama Role</th>
                                <th style="width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $item)
                            <tr>
                                <td>{{ $item->idrole }}</td>
                                <td>{{ $item->nama_role }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('admin.roles.edit', $item->idrole) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('admin.roles.destroy', $item->idrole) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role {{ $item->nama_role }}? Tindakan ini tidak dapat dibatalkan jika masih ada user terkait.');" style="display:inline;">
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
                                <td colspan="3" class="text-center text-muted">Tidak ada data role yang terdaftar.</td>
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