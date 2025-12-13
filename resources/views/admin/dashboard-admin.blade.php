@extends('layouts.app')

@section('title', 'Dashboard Admin')

{{-- Use the content-header section for the title/breadcrumb bar --}}
@section('content-header', 'Dashboard Admin')

@section('content')
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