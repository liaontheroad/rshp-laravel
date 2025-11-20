<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori; 
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::tbale('kategori')->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Menggunakan ID model untuk mengabaikan unique check pada dirinya sendiri
        $validatedData = $this->validateKategori($request, $kategori->idkategori);

        // Menggunakan helper untuk memastikan format nama yang benar
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);

DB::table('kategori')
          ->where('idkategori', $kategori->idkategori)
          ->update([
              'nama_kategori' => $formattedName,
              // Update timestamp secara manual
              'updated_at' => now(),
          ]);
          
        return redirect()->route('admin.kategori-hewan.index')
                         ->with('success', 'Kategori hewan berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        // NOTE: Pengecekan relasi dengan model 'Hewan' (yang diasumsikan)
        // if ($kategori->hewan()->count() > 0) {
        //     return redirect()->route('admin.kategori-hewan.index')
        //                      ->with('error', 'Gagal menghapus kategori karena masih terkait dengan data hewan.');
        // }

        try {
            $kategori->delete();
            return redirect()->route('admin.kategori-hewan.index')
                             ->with('success', 'Kategori hewan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-hewan.index')
                             ->with('error', 'Gagal menghapus kategori. Pastikan tidak ada data yang terkait.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateKategori($request);

        // Menggunakan helper untuk memastikan format nama yang benar
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);
DB::table('kategori')->insert([
    'nama_kategori' => $validatedData['nama_kategori'],
  'created_at' => now(),
  'updated_at' => now(),
]);

        return redirect()->route('admin.kategori-hewan.index')
                         ->with('success', 'Kategori hewan berhasil ditambahkan.');
    }

    private function validateKategori(Request $request, $id = null)
    {
        // Mendefinisikan rule unique dan mengecualikan ID saat update
        $uniqueRule = Rule::unique('kategori', 'nama_kategori');
        if ($id) {
            $uniqueRule->ignore($id, 'idkategori');
        }

        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);
    }

    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
