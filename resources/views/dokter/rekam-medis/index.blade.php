@extends('layouts.app')

{{-- Title --}}
@section('title', 'Antrian Pasien')

{{-- Content Header --}}
@section('content-header', 'Antrian Pasien Hari Ini')

{{-- Page Content --}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Antrian Pasien</h3>
        </div>
        <div class="card-body">
            {{-- Session Messages --}}
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No. Urut</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todays_appointments as $app)
                            <tr>
                                <td class="text-center fs-4 fw-bold">{{ $app->no_urut }}</td>
                                <td>{{ $app->nama_pet }}</td>
                                <td>{{ $app->nama_pemilik }}</td>
                                <td>{{ $app->nama_dokter }}</td>
                                <td class="text-center">
                                    @switch($app->status)
                                        @case(1)
                                            <span class="badge bg-warning">Pending</span>
                                        @break
                                        @case(2)
                                            <span class="badge bg-info">In Progress</span>
                                        @break
                                        @case(3)
                                            <span class="badge bg-success">Finished</span>
                                        @break
                                        @case(0)
                                            <span class="badge bg-danger">Cancelled</span>
                                        @break
                                        @default
                                            <span class="badge bg-secondary">Unknown</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    {{-- Actions for 'Pending' status --}}
                                    @if ($app->status == 1)
                                        <form action="{{ route('dokter.rekam-medis.updateStatus', $app->idreservasi_dokter) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="panggil">
                                            <button type="submit" class="btn btn-primary btn-sm">Panggil Pasien</button>
                                        </form>
                                        <form action="{{ route('dokter.rekam-medis.updateStatus', $app->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan janji temu ini?');">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancel">
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                        </form>
                                    @endif

                                    {{-- Actions for 'In Progress' status --}}
                                    @if ($app->status == 2)
                                        <a href="{{ route('dokter.rekam-medis.create', ['pet' => $app->idpet, 'reservasi' => $app->idreservasi_dokter]) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-file-medical"></i> Isi Rekam Medis
                                        </a>
                                        <form action="{{ route('dokter.rekam-medis.updateStatus', $app->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin menandai pemeriksaan ini sebagai Selesai?');">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="btn btn-info btn-sm">Selesaikan</button>
                                        </form>
                                    @endif

                                    {{-- Action to view history (available if not pending) --}}
                                    @if ($app->status > 1)
                                        <a href="{{ route('dokter.rekam-medis.history', $app->idpet) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-history"></i> Lihat Riwayat
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada antrian untuk hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection