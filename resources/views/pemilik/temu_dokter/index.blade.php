@extends('layouts.app')

@section('title', 'Janji Temu Dokter')

@section('content-header', 'Janji Temu Dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Janji Temu Dokter</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No. Urut</th>
                                <th>Waktu Daftar</th>
                                <th>Nama Pet</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($temuDokter as $appointment)
                            <tr>
                                <td>{{ $appointment->no_urut }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->waktu_daftar)->format('d M Y, H:i') }}</td>
                                <td>{{ $appointment->pet->nama }}</td>
                                <td>{{ $appointment->dokter->user->nama }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada janji temu dokter.</td>
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
