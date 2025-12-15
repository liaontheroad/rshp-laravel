<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet; // Assuming you have a Pet model
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'ras.jenis'])->get();
        return view('dokter.pets.index', compact('pets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     */
    public function show(Pet $pet)
    {
        // The {pet} from the URL is automatically found and injected by Laravel.
        return view('dokter.pets.show', compact('pet'));
    }
}