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
        $todays_appointments = DB::table('temu_dokter as rd')
            ->join('pet as p', 'rd.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u_pemilik', 'pm.iduser', '=', 'u_pemilik.iduser')
            ->join('role_user as ru_dokter', 'rd.idrole_user', '=', 'ru_dokter.idrole_user')
            ->join('user as u_dokter', 'ru_dokter.iduser', '=', 'u_dokter.iduser')
            ->whereDate('rd.waktu_daftar', Carbon::today())
            ->select(
                'rd.idreservasi_dokter',
                'rd.no_urut',
                'p.nama as nama_pet',
                'u_pemilik.nama as nama_pemilik',
                'u_dokter.nama as nama_dokter',
                'p.idpet',
                'rd.status'
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
            DB::table('temu_dokter')->where('idreservasi_dokter', $idreservasi)->update(['status' => $new_status]);
            return redirect()->route('dokter.rekam-medis.index')->with('message', $message);
        }

        return redirect()->route('dokter.rekam-medis.index')->with('error', 'Aksi tidak valid.');
    }

    /**
     * Show the form for creating a new medical record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $pet_id = $request->query('pet');
        $reservasi_id = $request->query('reservasi');

        // Fetch pet details
        $pet = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->where('p.idpet', $pet_id)
            ->select('p.*', 'u.nama as nama_pemilik')
            ->first();

        // Fetch appointment details
        $appointment = DB::table('temu_dokter')->where('idreservasi_dokter', $reservasi_id)->first();

        // Fetch available treatments
        $tindakan_terapi = DB::table('kode_tindakan_terapi')->get();

        return view('dokter.rekam-medis.create', compact('pet', 'appointment', 'tindakan_terapi'));
    }

    /**
     * Store a newly created medical record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|integer',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan_terapi' => 'array',
            'tindakan_terapi.*' => 'integer',
        ]);

        // Get current user (doctor)
        $user = auth()->user();
        $dokter = DB::table('dokter')->where('iduser', $user->iduser)->first();

        // Insert into rekam_medis
        $rekamMedisId = DB::table('rekam_medis')->insertGetId([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $user->iduser,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert detail tindakan if provided
        if ($request->has('tindakan_terapi') && is_array($request->tindakan_terapi)) {
            foreach ($request->tindakan_terapi as $tindakan_id) {
                DB::table('detail_rekam_medis')->insert([
                    'idrekam_medis' => $rekamMedisId,
                    'idkode_tindakan_terapi' => $tindakan_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Update appointment status to finished
        DB::table('temu_dokter')->where('idreservasi_dokter', $request->idreservasi_dokter)->update(['status' => 3]);

        return redirect()->route('dokter.rekam-medis.index')->with('message', 'Rekam medis berhasil dibuat.');
    }

    /**
     * Display the medical history for a specific pet.
     *
     * @param  int  $pet_id
     * @return \Illuminate\View\View
     */
    public function history($pet_id)
    {
        // Fetch pet details
        $pet = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->where('p.idpet', $pet_id)
            ->select('p.*', 'u.nama as nama_pemilik')
            ->first();

        // Fetch medical records for this pet
        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->leftJoin('user as dokter', 'rm.dokter_pemeriksa', '=', 'dokter.iduser')
            ->where('td.idpet', $pet_id)
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.anamnesa',
                'rm.temuan_klinis',
                'rm.diagnosa',
                'dokter.nama as nama_dokter'
            )
            ->orderBy('rm.created_at', 'desc')
            ->get();

        return view('dokter.rekam-medis.history', compact('pet', 'rekamMedis'));
    }
}
