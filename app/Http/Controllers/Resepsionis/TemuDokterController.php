<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    public function index()
    {
        $todays_appointments = TemuDokter::getTodaysAppointments();

        return view('resepsionis.temu-dokter.index', compact('todays_appointments'));
    }

    public function create()
    {
        $pets = Pet::with(['pemilik', 'rasHewan'])->get();
        $doctors = RoleUser::with('user')
            ->whereHas('role', function($query) {
                $query->where('nama_role', 'Dokter');
            })
            ->where('status', 1)
            ->get();

        return view('resepsionis.temu-dokter.create', compact('pets', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        $appointment = TemuDokter::daftar($request->idpet, $request->idrole_user);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', "Pendaftaran temu dokter berhasil! Nomor urut: " . $appointment->no_urut);
    }

    public function edit($id)
    {
        $appointment = TemuDokter::getById($id);

        if (!$appointment) {
            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('error', 'Janji temu tidak ditemukan.');
        }

        $pets = Pet::with(['pemilik', 'rasHewan'])->get();
        $doctors = RoleUser::with('user')
            ->whereHas('role', function($query) {
                $query->where('nama_role', 'Dokter');
            })
            ->where('status', 1)
            ->get();

        return view('resepsionis.temu-dokter.edit', compact('appointment', 'pets', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        $appointment = TemuDokter::find($id);

        if (!$appointment) {
            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('error', 'Janji temu tidak ditemukan.');
        }

        $appointment->updateAppointment($request->idpet, $request->idrole_user);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Janji temu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $appointment = TemuDokter::find($id);

        if (!$appointment) {
            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('error', 'Janji temu tidak ditemukan.');
        }

        $appointment->delete();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Janji temu berhasil dihapus.');
    }
}
