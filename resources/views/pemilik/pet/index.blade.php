@extends('layouts.app')

@section('title', 'Data Peliharaan')

@section('content-header', 'Data Peliharaan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peliharaan Saya</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama Pet</th>
                                <th>Jenis Hewan</th>
                                <th>Ras</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                @if($pets->count() > 1)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pets as $pet)
                            <tr>
                                <td>{{ $pet->nama }}</td>
                                <td>{{ $pet->rasHewan->jenis->nama_jenis_hewan ?? 'N/A' }}</td>
                                <td>{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                                <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                                <td>{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : 'N/A' }}</td>
                                @if($pets->count() > 1)
                                <td>
                                    <a href="{{ route('pemilik.pets.show', $pet->idpet) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data peliharaan.</td>
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
