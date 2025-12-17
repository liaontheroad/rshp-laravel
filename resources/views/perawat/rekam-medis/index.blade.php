@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content-header', 'Rekam Medis')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Rekam Medis</h3>
                        <div class="card-tools">
                            <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah Rekam Medis
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Hewan</th>
                                        <th>Pemilik</th>
                                        <th>Anamnesa</th>
                                        <th>Diagnosa</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekamMedis as $index => $rekam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rekam->pet->nama ?? 'N/A' }}</td>
                                            <td>{{ $rekam->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                            <td>{{ Str::limit($rekam->anamnesa, 50) }}</td>
                                            <td>{{ Str::limit($rekam->diagnosa, 50) }}</td>
                                            <td>{{ $rekam->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('perawat.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="{{ route('perawat.rekam-medis.edit', $rekam->idrekam_medis) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('perawat.rekam-medis.destroy', $rekam->idrekam_medis) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus rekam medis ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data rekam medis.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
