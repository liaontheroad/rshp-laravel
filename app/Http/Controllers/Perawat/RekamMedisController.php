<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet', 'dokter'])->get();
        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $pets = Pet::all();
        return view('perawat.rekam-medis.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pets,idpet',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        RekamMedis::create([
            'idpet' => $request->idpet,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'dokter_pemeriksa' => auth()->user()->idrole_user, // Assuming perawat can create records
        ]);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pet', 'dokter', 'detailRekamMedis'])->findOrFail($id);
        return view('perawat.rekam-medis.show', compact('rekamMedis'));
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $pets = Pet::all();
        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'pets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet' => 'required|exists:pets,idpet',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($request->only(['idpet', 'anamnesa', 'temuan_klinis', 'diagnosa']));

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus');
    }
}
