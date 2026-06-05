<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Tampilkan form tambah pengguna.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone',
            'role' => 'required|in:admin,user',
        ]);

        User::create($request->all());

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
        ]);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
