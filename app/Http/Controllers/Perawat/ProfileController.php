<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('perawat.profile.index');
    }

    public function show()
    {
        return view('perawat.profile.index');
    }
}