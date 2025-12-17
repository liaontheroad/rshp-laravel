@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content-header', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Janji Temu Hari Ini</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No. Urut</th>
                                <th>Waktu Daftar</th>
                                <th>Nama Pet</th>
                                <th>Pemilik</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\TemuDokter::getTodaysAppointments() as $appointment)
                            <tr>
                                <td>{{ $appointment['no_urut'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment['waktu_daftar'])->format('d M Y, H:i') }}</td>
                                <td>{{ $appointment['nama_pet'] }}</td>
                                <td>{{ $appointment['nama_pemilik'] }}</td>
                                <td>{{ $appointment['nama_dokter'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada janji temu untuk hari ini.</td>
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
