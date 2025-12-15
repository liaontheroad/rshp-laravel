<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\Auth;

class TemuDokterController extends Controller
{
    /**
     * Menampilkan daftar temu dokter (janji temu) milik user yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            abort(403, 'Akses ditolak. User bukan pemilik hewan.');
        }

        // Mengambil data temu dokter berdasarkan hewan yang dimiliki pemilik
        $temuDokter = TemuDokter::whereHas('pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->with(['pet', 'dokter'])
        ->latest()
        ->get();

        return view('pemilik.temu_dokter.index', compact('temuDokter'));
    }

    /**
     * Menampilkan detail temu dokter.
     */
    public function show($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $temuDokter = TemuDokter::whereHas('pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->with(['pet', 'dokter'])
        ->findOrFail($id);

        return view('pemilik.temu_dokter.show', compact('temuDokter'));
    }
}
