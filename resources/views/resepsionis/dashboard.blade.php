@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content-header', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Pet::count() }}</h3>
                    <p>Total Pasien (Hewan)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <a href="{{ route('admin.pets.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Pemilik::count() }}</h3>
                    <p>Total Pemilik</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="{{ route('admin.pemilik.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\TemuDokter::whereDate('waktu_daftar', today())->count() }}</h3>
                    <p>Janji Temu Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="small-box-footer">&nbsp;</div>
            </div>
        </div>
    </div>

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
