<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Menampilkan daftar semua pet (pasien).
     */
    public function index()
    {
        // Eager load relationships to prevent N+1 query issues
        $pets = Pet::with(['pemilik', 'rasHewan.jenis'])->orderBy('idpet', 'asc')->get();
        return view('admin.pets.index', compact('pets'));
    }
}
