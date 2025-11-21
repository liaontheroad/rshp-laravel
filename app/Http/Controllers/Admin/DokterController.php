<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Role; // Untuk menautkan role

class DokterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input (Anda harus membuat private function validateDokter())
        // $validatedData = $this->validateDokter($request); 
        // Untuk contoh ini, kita langsung gunakan request

        DB::beginTransaction(); // <<=== MEMULAI TRANSAKSI ===>>
        try {
            // 1. Buat User Baru
            $user = User::create([
                'name' => $request->nama, // Asumsi nama dari form
                'email' => $request->email,
                'password' => Hash::make($request->password), // Wajib di-hash
            ]);

            // 2. Tautkan Role (Asumsi ID 2 adalah Dokter)
            $roleDokter = Role::find(2); 
            // Menggunakan method attach() untuk relasi Many-to-Many
            $user->roles()->attach($roleDokter->id); 

            // 3. Buat Profil Dokter
            Dokter::create([
                'id_user' => $user->id,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'bidang_dokter' => $request->bidang_dokter,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
            
            DB::commit(); // <<=== SEMUA BERHASIL, SIMPAN PERUBAHAN ===>>

            return redirect()->route('admin.dokter.index')->with('success', 'Data Dokter berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack(); // <<=== ADA GAGAL, BATALKAN SEMUA PERUBAHAN ===>>
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}