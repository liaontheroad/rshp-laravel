@extends('layouts.app')

@section('content-header', 'Manajemen Data Pet (Pasien)')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pet (Pasien)</h3>
                <div class="card-tools">
                    <a href="{{ route('dokter.pets.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Data Pet
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
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
                                <td>
                                    <a href="{{ route('dokter.pets.edit', $pet->idpet) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('dokter.pets.destroy', $pet->idpet) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pet ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data pet (pasien).</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
