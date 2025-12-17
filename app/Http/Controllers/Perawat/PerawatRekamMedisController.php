<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatRekamMedisController extends Controller
{
    // ==========================
    // INDEX — Daftar Riwayat Medis
    // ==========================
    public function index(Request $request)
    {
        try {
            // Query Data Rekam Medis
            $query = DB::table('rekam_medis as rm')
                // Hubungkan ke Reservasi & Pet untuk validasi kepemilikan
                ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
                ->join('pet as p', 'td.idpet', '=', 'p.idpet')
                // Ambil data dokter (Left Join agar tidak error jika dokter dihapus)
                ->leftJoin('user as dokter', 'rm.dokter_pemeriksa', '=', 'dokter.iduser')

                ->select(
                    'rm.idrekam_medis',
                    'rm.created_at',
                    'rm.diagnosa',
                    'p.nama as nama_pet',
                    'dokter.nama as nama_dokter'
                )
                ->orderBy('rm.created_at', 'desc');

            // Eksekusi Query dengan Pagination
            $rekamMedis = $query->paginate(10);

            return view('perawat.rekam-medis.index', compact('rekamMedis'));

        } catch (\Throwable $e) {
            // Tampilkan error spesifik agar mudah diperbaiki
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ==========================
    // SHOW — Detail Rekam Medis
    // ==========================
    public function show($id)
    {
        try {
            // 1. Ambil Header Rekam Medis
            $rekamMedis = DB::table('rekam_medis as rm')
                ->leftJoin('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
                ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
                ->leftJoin('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
                ->leftJoin('jenis_hewan as jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
                ->leftJoin('pemilik as pem', 'p.idpemilik', '=', 'pem.idpemilik') // Join tabel pemilik
                ->leftJoin('user as dokter', 'rm.dokter_pemeriksa', '=', 'dokter.iduser')

                // Select Data
                ->select(
                    'rm.*',
                    'p.nama as nama_pet',
                    'jh.nama_jenis_hewan as jenis_hewan',
                    'rh.nama_ras as ras',
                    'pem.no_wa', // Tambahkan no_wa
                    'dokter.nama as nama_dokter'
                )
                ->where('rm.idrekam_medis', $id)
                ->first();

            if (!$rekamMedis) {
                return back()->with('error', 'Data rekam medis tidak ditemukan.');
            }

            // 2. Ambil Detail Tindakan (Jika tabel detail tersedia)
            $detailRekamMedis = DB::table('detail_rekam_medis as drm')
                ->join('kode_tindakan_terapi as ktt', 'drm.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
                ->where('drm.idrekam_medis', $id)
                ->select('drm.*', 'ktt.kode', 'ktt.deskripsi_tindakan_terapi')
                ->get();

            return view('perawat.rekam-medis.show', compact('rekamMedis', 'detailRekamMedis'));

        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal memuat detail: ' . $e->getMessage());
        }
    }
}
