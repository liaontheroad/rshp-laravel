<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relationships for efficiency
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenis'])->latest('idpet')->get();
        return view('dokter.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch owners and animal types for dropdowns
        $pemiliks = Pemilik::with('user')->get()->sortBy('user.nama');
        $jenisHewans = JenisHewan::orderBy('nama_jenis_hewan')->get();

        return view('dokter.pets.create', compact('pemiliks', 'jenisHewans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);

        // The 'nama' field in the database is 'nama_pet'
        $validatedData['nama_pet'] = $validatedData['nama'];
        unset($validatedData['nama']); // Remove the temporary 'nama' key

        Pet::create($validatedData);

        return redirect()->route('dokter.pets.index')
                         ->with('success', 'Data Pasien (Pet) berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $pemiliks = Pemilik::with('user')->get()->sortBy('user.nama');
        $jenisHewans = JenisHewan::orderBy('nama_jenis_hewan')->get();

        // Eager load the relationship to avoid issues in the view
        $pet->load('rasHewan');

        return view('dokter.pets.edit', compact('pet', 'pemiliks', 'jenisHewans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validatedData = $this->validatePet($request, $pet->idpet);

        $validatedData['nama_pet'] = $validatedData['nama'];
        unset($validatedData['nama']);

        $pet->update($validatedData);

        return redirect()->route('dokter.pets.index')
                         ->with('success', 'Data Pasien (Pet) berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        try {
            $pet->delete();
            return redirect()->route('dokter.pets.index')
                             ->with('success', 'Data Pasien (Pet) berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle potential foreign key constraint violations
            return redirect()->route('dokter.pets.index')
                             ->with('error', 'Gagal menghapus data pasien. Kemungkinan data ini memiliki rekam medis terkait.');
        }
    }

    /**
     * Fetch breeds for a given animal type via AJAX.
     */
    public function getBreeds($idjenis_hewan)
    {
        $breeds = RasHewan::where('idjenis_hewan', $idjenis_hewan)->orderBy('nama_ras_hewan')->get();
        return response()->json($breeds);
    }

    /**
     * Helper function to validate pet data.
     */
    private function validatePet(Request $request, $id = null)
    {
        // The form sends 'nama_pet', but the validation rule expects 'nama' from the old controller.
        // We'll rename it for validation and then map it back.
        $request->merge(['nama' => $request->nama_pet]);

        return $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            // The form sends 'idjenis_hewan', which is correct for the rule below.
            'idras_hewan' => [
                'required',
                Rule::exists('ras_hewan', 'idras_hewan')->where(function ($query) use ($request) {
                    // This ensures the selected breed belongs to the selected animal type
                    $jenisHewanId = $request->input('idjenis_hewan');
                    if ($jenisHewanId) {
                        return $query->where('idjenis_hewan', $jenisHewanId);
                    }
                    return $query;
                }),
            ],
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:J,B', // 'J' for Jantan, 'B' for Betina
            'warna_tanda' => 'nullable|string|max:100',
        ], [
            'nama.required' => 'Nama pasien tidak boleh kosong.',
            'idpemilik.required' => 'Pemilik harus dipilih.',
            'idras_hewan.required' => 'Ras hewan harus dipilih.',
            'idras_hewan.exists' => 'Ras hewan tidak cocok dengan jenis hewan yang dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'warna_tanda.max' => 'Warna/tanda maksimal 100 karakter.',
        ]);
    }
}
