<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan; 

class RasHewanController extends Controller
{
    public function index ()
    {
        // Fetch all JenisHewan and eager load their associated RasHewan.
        // This structure matches the view's expectation to group by animal type.
        $jenisHewanWithRaces = JenisHewan::with('rasHewan')->get();
        return view('admin.ras-hewan.index', compact('jenisHewanWithRaces'));
    }

}