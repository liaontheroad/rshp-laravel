@extends('layouts.app')

{{-- Judul Halaman yang Muncul di Tab Browser --}}
@section('title', 'Manajemen Data Pasien (Pets)')

{{-- Judul Konten yang Muncul di Breadcrumb Bar --}}
@section('content-header', 'Manajemen Data Pasien')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline"> {{-- Menggunakan card-primary untuk warna utama --}}
            <div class="card-header">
                <h3 class="card-title">Daftar Pasien (Hewan Peliharaan)</h3>
                <div class="card-tools">
                    {{-- Tombol Tambah di kanan atas Card --}}
                    <a href="{{ route('admin.pets.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-paw"></i> Tambah Pasien Baru
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
                                <th style="width: 15%">Nama Pasien</th>
                                <th style="width: 15%">Pemilik</th>
                                <th style="width: 10%">Jenis</th>
                                <th style="width: 10%">Ras</th>
                                <th style="width: 10%">Kelamin</th>
                                <th style="width: 10%">Tanggal Lahir</th>
                                <th style="width: 15%; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pets as $pet)
                            <tr>
                                <td>{{ $pet['idpet'] }}</td>
                                <td><strong>{{ $pet['nama_pet'] }}</strong></td>
                                <td>{{ $pet['nama_pemilik'] ?? 'N/A' }}</td>
                                <td>{{ $pet['nama_jenis_hewan'] ?? 'N/A' }}</td>
                                <td>{{ $pet['nama_ras'] ?? 'N/A' }}</td>
                                <td>
                                    {{-- Menggunakan badge untuk Jenis Kelamin --}}
                                    @if ($pet['jenis_kelamin'] == 'J')
                                        <span class="badge bg-primary">Jantan</span>
                                    @elseif ($pet['jenis_kelamin'] == 'B')
                                        <span class="badge bg-danger">Betina</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pet['tanggal_lahir'])->format('d M Y') }}</td>
                                
                                <td class="text-center d-flex justify-content-center gap-2">
                                    {{-- Link Edit --}}
                                    <a href="{{ route('admin.pets.edit', $pet['idpet']) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('admin.pets.destroy', $pet['idpet']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien {{ $pet['nama_pet'] }}?');" style="display:inline;">
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
                                <td colspan="8" class="text-center text-muted">Tidak ada data pasien yang terdaftar.</td>
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