<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    /**
     * Tampilkan daftar siswa dengan pagination (5 data per halaman).
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->orderBy('id', 'desc')->paginate(5);
        return view('backend.siswa.index', compact('siswa'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('backend.siswa.create', compact('kelas'));
    }

    /**
     * Simpan data siswa ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nisn.unique' => 'NISN sudah terdaftar!',
            'nama_siswa.required' => 'Nama siswa harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'kelas_id.required' => 'Nama kelas harus dipilih!',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit siswa.
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('backend.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update data siswa di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn,' . $id,
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nisn.unique' => 'NISN sudah digunakan!',
            'nama_siswa.required' => 'Nama siswa harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'kelas_id.required' => 'Nama kelas harus dipilih!',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui!');
    }

    /**
     * Hapus data siswa dari database.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
}
