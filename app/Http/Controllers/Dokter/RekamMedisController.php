<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of today's appointments for the medical records queue.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch today's appointments using Query Builder, similar to the original PHP logic.
        $todays_appointments = DB::table('reservasi_dokter as rd')
            ->join('pets as p', 'rd.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('users as u_pemilik', 'pm.iduser', '=', 'u_pemilik.iduser')
            ->join('role_user as ru_dokter', 'rd.idrole_user_dokter', '=', 'ru_dokter.idrole_user')
            ->join('users as u_dokter', 'ru_dokter.iduser', '=', 'u_dokter.iduser')
            ->whereDate('rd.tanggal_reservasi', Carbon::today())
            ->select(
                'rd.idreservasi_dokter',
                'rd.no_urut',
                'p.nama_pet',
                'u_pemilik.name as nama_pemilik',
                'u_dokter.name as nama_dokter',
                'rd.status',
                'p.idpet'
            )
            ->orderBy('rd.no_urut', 'asc')
            ->get();

        return view('dokter.rekam-medis.index', compact('todays_appointments'));
    }

    /**
     * Update the status of an appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idreservasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $idreservasi)
    {
        $action = $request->input('status');
        $new_status = null;
        $message = 'Status antrian berhasil diubah.';

        switch ($action) {
            case 'panggil':
                $new_status = 2; // In Progress
                break;
            case 'selesai':
                $new_status = 3; // Finished
                break;
            case 'cancel':
                $new_status = 0; // Cancelled
                $message = 'Antrian berhasil dibatalkan.';
                break;
        }

        if (!is_null($new_status)) {
            DB::table('reservasi_dokter')->where('idreservasi_dokter', $idreservasi)->update(['status' => $new_status]);
            return redirect()->route('dokter.rekam-medis.index')->with('message', $message);
        }

        return redirect()->route('dokter.rekam-medis.index')->with('error', 'Aksi tidak valid.');
    }
}
