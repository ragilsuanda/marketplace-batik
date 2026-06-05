<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminKelasController extends Controller
{
    /**
     * Tampilkan daftar kelas.
     */
    public function index()
    {
        $kelas = Kelas::paginate(5);
        return view('backend.kelas.index', compact('kelas'));
    }

    /**
     * Tampilkan form tambah kelas.
     */
    public function create()
    {
        return view('backend.kelas.create');
    }

    /**
     * Simpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah ada! Silakan gunakan nama lain.', // Custom pesan error
            'nama_kelas.required' => 'Nama kelas tidak boleh kosong!',
        ]);

        Kelas::create(['nama_kelas' => $request->nama_kelas]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }


    /**
     * Tampilkan form edit kelas.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('backend.kelas.edit', compact('kelas'));
    }

    /**
     * Update data kelas.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id,
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah ada! Silakan gunakan nama lain.', // Custom pesan error
            'nama_kelas.required' => 'Nama kelas tidak boleh kosong!',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update(['nama_kelas' => $request->nama_kelas]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    /**
     * Hapus kelas dari database.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
