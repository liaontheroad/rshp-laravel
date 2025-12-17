<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemilikTemuDokterController extends Controller
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
        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->join('pet as p', 'temu_dokter.idpet', '=', 'p.idpet')
            ->join('user as pemilik_user', 'p.idpemilik', '=', 'pemilik_user.iduser')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select('temu_dokter.*', 'pet.nama as pet_nama', 'dokter_user.nama as dokter_nama')
            ->orderBy('temu_dokter.idreservasi_dokter', 'desc')
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

        $temuDokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
            ->join('user as dokter_user', 'role_user.iduser', '=', 'dokter_user.iduser')
            ->join('pet as p', 'temu_dokter.idpet', '=', 'p.idpet')
            ->join('user as pemilik_user', 'p.idpemilik', '=', 'pemilik_user.iduser')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->where('temu_dokter.idreservasi_dokter', $id)
            ->select('temu_dokter.*', 'pet.nama as pet_nama', 'dokter_user.nama as dokter_nama')
            ->first();

        if (!$temuDokter) {
            abort(404);
        }

        return view('pemilik.temu_dokter.show', compact('temuDokter'));
    }
}
