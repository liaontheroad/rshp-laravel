<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Ensure this view exists or update to match your requirements
        return view('dokter.profile.index');
    }

    public function show()
    {
        return view('dokter.profile.index');
    }
}
