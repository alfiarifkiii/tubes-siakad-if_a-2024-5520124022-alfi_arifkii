<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // 1. Menampilkan daftar jadwal (KHUSUS ADMIN)
    public function index()
    {
        // Memanggil jadwal beserta relasi dosen dan matakuliah
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])->get();
        return view('jadwal.index', compact('jadwals'));
    }

    // 2. Menampilkan jadwal (KHUSUS MAHASISWA)
    public function jadwalMahasiswa()
    {
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])->get();
        return view('jadwal.mahasiswa', compact('jadwals'));
    }

    // 3. Form tambah jadwal (Admin)
    public function create()
    {
        $matakuliahs = Matakuliah::all();
        $dosens = Dosen::all();
        return view('jadwal.create', compact('matakuliahs', 'dosens'));
    }

    // 4. Menyimpan data jadwal (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliahs,kode_matakuliah',
            'nidn' => 'required|exists:dosens,nidn',
            'kelas' => 'required|string|max:5',
            'hari' => 'required|string',
            'jam' => 'required',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // 5. Form edit jadwal (Admin)
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $matakuliahs = Matakuliah::all();
        $dosens = Dosen::all();
        return view('jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens'));
    }

    // 6. Update data jadwal (Admin)
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliahs,kode_matakuliah',
            'nidn' => 'required|exists:dosens,nidn',
            'kelas' => 'required|string|max:5',
            'hari' => 'required|string',
            'jam' => 'required',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    // 7. Hapus jadwal (Admin)
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}