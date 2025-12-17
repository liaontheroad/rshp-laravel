<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PerawatPetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->get();
        return view('perawat.pets.index', compact('pets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     */
    public function show(Pet $pet)
    {
        $pet->load(['pemilik.user', 'rasHewan.jenisHewan']);
        return view('perawat.pets.show', compact('pet'));
    }
}
