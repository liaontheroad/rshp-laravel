@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Daftar Jenis Hewan')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Manajemen Jenis Hewan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Jenis Hewan</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Tambah Jenis Hewan
                    </a>
                </div>
            </div>

            <div class="card-body">
                {{-- Flash Message (menggunakan Bootstrap Alert dan dismissible) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                {{-- Tabel Data (Menggunakan kelas Bootstrap 5: table, table-bordered, table-hover) --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Jenis Hewan</th>
                                <th style="width: 15%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop untuk menampilkan data dari Controller --}}
                            @foreach ($jenisHewan as $index => $hewan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $hewan->nama_jenis_hewan }}</td>
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('admin.jenis-hewan.edit', $hewan->idjenis_hewan) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    {{-- Link Hapus (Delete Form) --}}
                                    <form action="{{ route('admin.jenis-hewan.destroy', $hewan->idjenis_hewan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus jenis hewan ini?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if ($jenisHewan->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Tidak ada data jenis hewan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Kembali di bawah tabel --}}
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