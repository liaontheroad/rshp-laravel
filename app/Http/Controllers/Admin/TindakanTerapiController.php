<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TindakanTerapi;

class TindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakanTerapi = TindakanTerapi::all();
        return view('admin.tindakan-terapi.index', compact('tindakanTerapi'));
    }
}