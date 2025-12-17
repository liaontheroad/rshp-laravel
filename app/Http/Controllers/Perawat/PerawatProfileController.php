<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatProfileController extends Controller
{
    public function index()
    {
        $perawat = Auth::user()->perawat->load('user');
        return view('perawat.profile.index', compact('perawat'));
    }

    public function show()
    {
        $perawat = Auth::user()->perawat->load('user');
        return view('perawat.profile.index', compact('perawat'));
    }
}