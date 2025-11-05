@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Selamat Datang, {{ session('user_name') }}!</h4>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form-dashboard').submit();">
                        Logout
                    </a>
                </div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p>Anda login sebagai <strong>{{ session('user_role_name') }}</strong>. KEEP ON TRACK UR PETS.</p>

                    <hr>

                    <h5><i class="fas fa-database"></i> Menu </h5>
                    <div class="row mt-3">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('pemilik.pets.index') }}" class="btn btn-outline-primary btn-block w-100">Data Peliharaan Saya</a>
                        </div>
                    </div>
                </div>

                <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection