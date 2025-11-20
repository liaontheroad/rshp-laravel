<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index ()
    {
    //$jenisHewan = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
    $jenisHewan = JenisHewan::all();
    return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateJenisHewan($request);

        JenisHewan::create($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit(JenisHewan $jenisHewan)
    {
        return view('admin.jenis-hewan.edit.edit', compact('jenisHewan'));
    }

    public function update(Request $request, JenisHewan $jenisHewan)
    {
        $validatedData = $this->validateJenisHewan($request);

        $jenisHewan->update($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Jenis hewan berhasil diperbarui.');
    }

    public function destroy(JenisHewan $jenisHewan)
    {
        try {
            $jenisHewan->delete();
            return redirect()->route('admin.jenis-hewan.index')
                             ->with('success', 'Jenis hewan berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Menangkap error foreign key constraint
            return redirect()->route('admin.jenis-hewan.index')
                             ->with('error', 'Gagal menghapus jenis hewan karena masih terkait dengan data lain.');
        }
    }

    private function validateJenisHewan(Request $request, $id = null) 
    {
        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan tidak boleh kosong.',
            'nama_jenis_hewan.string' =>'Nma'
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.',
        ]);
    }
}

?>