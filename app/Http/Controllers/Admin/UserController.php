<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validasi tanpa ID (create mode)
        $validatedData = $this->validateUser($request);

        // Extract idrole for role assignment
        $idrole = $validatedData['idrole'];
        unset($validatedData['idrole']);

        // Jika Model User.php TIDAK memiliki mutator setPasswordAttribute($password)
        // Maka Anda perlu melakukan hashing secara manual di sini:
        // $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        // Assign role via pivot table
        $user->roles()->sync([$idrole]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi dengan ID user (update mode)
        $validatedData = $this->validateUser($request, $user->id);

        // Extract idrole for role assignment
        $idrole = $validatedData['idrole'];
        unset($validatedData['idrole']);

        // Hanya update password jika diisi
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            // Mutator di model akan melakukan hashing jika ada.
            // Jika tidak ada, tambahkan: $validatedData['password'] = Hash::make($validatedData['password']);
            $user->password = $validatedData['password'];
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        // Sync role via pivot table
        $user->roles()->sync([$idrole]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Pencegahan penghapusan diri sendiri
        if (auth()->user()->iduser == $user->iduser) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                             ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Gagal menghapus user. Terjadi kesalahan sistem atau masih ada data terkait.');
        }
    }

    private function validateUser(Request $request, $id = null)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($id, 'iduser'), // Mengabaikan ID user saat update
            ],
            // Asumsi tabel role memiliki primary key idrole
            'idrole' => 'required|exists:role,idrole',
            // Password: required saat create ($id=null), nullable saat update ($id!=null)
            'password' => [
                $id ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed', // Memastikan ada field password_confirmation
            ],
        ];
        $messages = [
            'nama.required' => 'Nama pengguna harus diisi.',
            'idrole.required' => 'Role pengguna harus dipilih.',
            'idrole.exists' => 'Role pengguna yang dipilih tidak valid.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            // ... pesan-pesan lainnya
        ];

        return $request->validate($rules, $messages);
    }
}
