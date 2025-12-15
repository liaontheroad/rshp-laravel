@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Rekam Medis</h3>
                    <div class="card-tools">
                        <form method="GET" action="{{ route('pemilik.rekam-medis.index') }}" class="d-inline">
                            <div class="input-group">
                                <select name="idpet" class="form-control form-control-sm">
                                    <option value="">Semua Hewan</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->idpet }}" {{ request('idpet') == $pet->idpet ? 'selected' : '' }}>
                                            {{ $pet->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if($rekamMedis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Pet</th>
                                        <th>Dokter Pemeriksa</th>
                                        <th>Diagnosa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekamMedis as $record)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>{{ $record->pet->nama_pet }}</td>
                                            <td>{{ $record->dokter->user->nama ?? 'N/A' }}</td>
                                            <td>{{ Str::limit($record->diagnosa, 50) }}</td>
                                            <td class="text-center d-flex justify-content-center gap-2">
                                                {{-- Link Detail --}}
                                                <a href="{{ route('pemilik.rekam-medis.show', $record->idrekam_medis) }}" class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center">
                            <p>Belum ada riwayat rekam medis untuk hewan peliharaan Anda.</p>
                        </div>
                    @endif

                    @if($rekamMedis->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $rekamMedis->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
