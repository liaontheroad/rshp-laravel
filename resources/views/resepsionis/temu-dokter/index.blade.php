@extends('layouts.app')

@section('title', 'Manajemen Janji Temu Dokter')

@section('content-header', 'Janji Temu Dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Janji Temu Hari Ini</h3>
                    <div class="card-tools">
                        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Janji Temu
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No. Urut</th>
                                <th>Waktu Daftar</th>
                                <th>Nama Pet</th>
                                <th>Pemilik</th>
                                <th>Dokter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todays_appointments as $appointment)
                            <tr>
                                <td>{{ $appointment['no_urut'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment['waktu_daftar'])->format('d M Y, H:i') }}</td>
                                <td>{{ $appointment['nama_pet'] }}</td>
                                <td>{{ $appointment['nama_pemilik'] }}</td>
                                <td>{{ $appointment['nama_dokter'] }}</td>
                                <td>
                                    <a href="{{ route('resepsionis.temu-dokter.edit', $appointment['idreservasi_dokter']) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('resepsionis.temu-dokter.destroy', $appointment['idreservasi_dokter']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus janji temu ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada janji temu untuk hari ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
