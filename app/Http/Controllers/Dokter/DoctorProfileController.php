<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{

     public function index()
    {
        $dokter = Auth::user()->dokter->load('user');
        return view('dokter.profile.index', compact('dokter'));
    }

    public function show()
    {
        $dokter = Auth::user()->dokter->load('user');
        return view('dokter.profile.index', compact('dokter'));
    }
}