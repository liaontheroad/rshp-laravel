<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna beserta rolenya.
     */
    public function index()
    {
        // Eager load relasi 'roles' untuk efisiensi query
        $users = User::with('roles')->orderBy('iduser', 'asc')->get();
        return view('admin.roles.index', compact('users'));
    }
}