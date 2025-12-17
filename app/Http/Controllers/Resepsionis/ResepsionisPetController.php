<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Validation\Rule;

class ResepsionisPetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan', 'jenisHewan'])
            ->get()
            ->map(function ($pet) {
                return [
                    'idpet' => $pet->idpet,
                    'nama_pet' => $pet->nama,
                    'nama_pemilik' => $pet->pemilik->user->nama ?? 'N/A',
                    'nama_jenis_hewan' => $pet->jenisHewan->nama_jenis_hewan ?? 'N/A',
                    'nama_ras' => $pet->rasHewan->nama_ras ?? 'N/A',
                    'jenis_kelamin' => $pet->jenis_kelamin,
                    'tanggal_lahir' => $pet->tanggal_lahir,
                ];
            });

        return view('resepsionis.pets.index', compact('pets'));
    }

    /**
     * Menampilkan formulir untuk membuat hewan peliharaan baru.
     */
    public function create()
    {
        $pemilik = Pemilik::with('user')->get()->map(function ($p) {
            return [
                'idpemilik' => $p->idpemilik,
                'nama' => $p->user->nama ?? $p->user->name ?? 'N/A'
            ];
        });
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        $rasHewan = RasHewan::with('jenis')->get();

        return view('resepsionis.pets.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Menyimpan hewan peliharaan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);

        $result = Pet::createPet(
            $validatedData['nama'],
            $validatedData['tanggal_lahir'],
            $validatedData['warna_tanda'],
            $validatedData['jenis_kelamin'],
            $validatedData['idpemilik'],
            $validatedData['idras_hewan']
        );

        if ($result['status'] === 'success') {
            return redirect()->route('resepsionis.pets.index')
                             ->with('success', $result['message']);
        } else {
            return redirect()->back()
                             ->withInput()
                             ->with('error', $result['message']);
        }
    }

    /**
     * Menampilkan formulir untuk mengedit hewan peliharaan tertentu.
     */
    public function edit($idpet)
    {
        $pet = Pet::with('rasHewan')->find($idpet);

        if (!$pet) {
            return redirect()->route('resepsionis.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }

        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        $rasHewan = RasHewan::with('jenis')->get();

        return view('resepsionis.pets.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Memperbarui hewan peliharaan tertentu di database.
     */
    public function update(Request $request, $idpet)
    {
        $pet = Pet::find($idpet);

        if (!$pet) {
             return redirect()->route('resepsionis.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }

        $validatedData = $this->validatePet($request, $pet->idpet);

        $pet->update($validatedData);

        return redirect()->route('resepsionis.pets.index')
                         ->with('success', 'Data Pasien (Pet) berhasil diperbarui.');
    }

    /**
     * Menghapus hewan peliharaan tertentu dari database.
     */
    public function destroy($idpet)
    {
        $pet = Pet::find($idpet);

        if (!$pet) {
             return redirect()->route('resepsionis.pets.index')
                             ->with('error', 'Pasien tidak ditemukan.');
        }

        try {
            $pet->delete();
            return redirect()->route('resepsionis.pets.index')
                             ->with('success', 'Data Pasien (Pet) berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('resepsionis.pets.index')
                             ->with('error', 'Gagal menghapus data pasien. Pastikan tidak ada rekam medis terkait.');
        }
    }

    /**
     * Helper untuk validasi data Pet.
     */
    private function validatePet(Request $request, $id = null)
    {
        return $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => [
                'required',
                Rule::exists('ras_hewan', 'idras_hewan')->where(function ($query) use ($request) {
                    return $query->where('idjenis_hewan', $request->idjenis_hewan);
                }),
            ],
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'nullable|string|max:100',
        ], [
            'idras_hewan.exists' => 'Ras hewan tidak cocok dengan jenis hewan yang dipilih.',
            'nama.required' => 'Nama pasien tidak boleh kosong.',
            'warna_tanda.max' => 'Warna/tanda maksimal 100 karakter.',
        ]);
    }
}
