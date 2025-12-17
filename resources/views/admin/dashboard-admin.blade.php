@extends('layouts.app')

@section('title', 'Dashboard Admin')

{{-- Use the content-header section for the title/breadcrumb bar --}}
@section('content-header', 'Dashboard Admin')

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

    {{-- Your actual dashboard content goes here --}}
    <div class="row">
         <h1>Selamat Datang, {{ session('user_name', 'Admin') }}!</h1>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Administrator') }}</strong>. Silakan kelola data master melalui menu di bawah ini.</p>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        Welcome to the new AdminLTE-themed Dashboard!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection