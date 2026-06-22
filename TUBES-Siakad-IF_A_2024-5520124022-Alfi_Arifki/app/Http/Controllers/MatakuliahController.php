<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = Matakuliah::all();
        return view('matakuliah.index', compact('matakuliahs'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:matakuliahs,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6', // SKS dibatasi angka 1 sampai 6
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah berhasil ditambahkan!');
    }

    public function edit($kode_matakuliah)
    {
        // Mencari data berdasarkan primary key (kode_matakuliah)
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $kode_matakuliah)
    {
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);

        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $matakuliah->update([
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks
        ]);

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah berhasil diperbarui!');
    }

    public function destroy($kode_matakuliah)
    {
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah berhasil dihapus!');
    }
}