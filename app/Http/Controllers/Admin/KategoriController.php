<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        // Perbaikan: 'tbale' menjadi 'table'
        $kategori = DB::table('kategori')->get();
        
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

        // Perbaikan: $formattedName tidak terdefinisi, seharusnya menggunakan $validatedData['nama_kategori']
        DB::table('kategori')
            ->where('idkategori', $kategori->idkategori)
            ->update([
                'nama_kategori' => $validatedData['nama_kategori'],
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori penanganan berhasil diperbarui.');
    }

public function destroy($id)
    {
        // Contoh di mana DB Facade mungkin digunakan untuk memeriksa relasi
        // sebelum menghapus.
        try {
            // Menggunakan DB facade untuk memeriksa relasi data
            $isInUse = DB::table('nama_tabel_lain') // Ganti dengan nama tabel yang relevan
                         ->where('idkategori', $id)
                         ->exists();

            if ($isInUse) {
                return redirect()->route('admin.kategori.index')
                                 ->with('error', 'Kategori penanganantidak dapat dihapus karena masih digunakan oleh data lain.');
            }

            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return redirect()->route('admin.kategori.index')
                             ->with('success', 'Kategori penanganan berhasil dihapus.');

        } catch (\Exception $e) {
            // Menangani error jika terjadi masalah saat query database
            return redirect()->route('admin.kategori.index')
                             ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
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

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori penanganan berhasil ditambahkan.');
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