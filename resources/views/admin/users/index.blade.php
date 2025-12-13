@extends('layouts.app')

@section('title', 'Manajemen User')
@section('content-header', 'Manajemen User')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Pengguna Sistem</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah --}}
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Tambah User Baru
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
                                <th>Nama</th>
                                <th style="width: 30%">Email</th>
                                <th style="width: 15%">Role</th>
                                <th style="width: 20%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->iduser }}</td> 
                                
                                {{-- Menggunakan $user->name jika kolom database adalah 'name' --}}
                                <td>{{ $user->name ?? $user->nama }}</td>
                                
                                <td>{{ $user->email }}</td>
                                
                                {{-- FIX: Menggunakan relasi BelongsToMany 'roles' yang sudah di eager load, filter by status 1 --}}
                                <td>{{ $user->roles->where('pivot.status', 1)->first()->nama_role ?? 'N/A' }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.users.edit', $user->iduser) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('admin.users.destroy', $user->iduser) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name ?? $user->nama }}?')" 
                                            {{-- Mencegah user menghapus diri sendiri --}}
                                            {{ Auth::check() && Auth::user()->iduser == $user->iduser ? 'disabled' : '' }} 
                                        >
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data user yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection