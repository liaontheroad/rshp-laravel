@extends('layouts.admin')

@section('title', 'Dashboard Admin')

{{-- Use the content-header section for the title/breadcrumb bar --}}
@section('content-header', 'Dashboard Admin')

@section('content')
    {{-- Your actual dashboard content goes here --}}
    <div class="row">
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