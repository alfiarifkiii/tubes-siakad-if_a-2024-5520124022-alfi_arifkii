<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap kata kunci dari form pencarian
        $search = $request->search;

        // Memfilter data jika ada pencarian, jika tidak tampilkan semua
        $dosens = Dosen::when($search, function ($query, $search) {
            return $query->where('nidn', 'like', "%{$search}%")
                         ->orWhere('nama', 'like', "%{$search}%");
        })->get(); 

        return view('dosen.index', compact('dosens'));
    }
    // 2. Menampilkan form tambah data
    public function create()
    {
        return view('dosen.create');
    }

    // 3. Menyimpan data ke database (CREATE)
    public function store(Request $request)
    {
        // Validasi Laravel (Syarat Wajib Tugas)
        $request->validate([
            'nidn' => 'required|size:10|unique:dosens,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nidn.size' => 'NIDN harus tepat 10 karakter.',
            'nama.required' => 'Nama dosen wajib diisi.',
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit data
    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('dosen.edit', compact('dosen'));
    }

    // 5. Menyimpan perubahan data (UPDATE)
    public function update(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);

        $request->validate([
            'nama' => 'required|string|max:50',
        ]);

        $dosen->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    // 6. Menghapus data (DELETE)
    public function destroy($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}