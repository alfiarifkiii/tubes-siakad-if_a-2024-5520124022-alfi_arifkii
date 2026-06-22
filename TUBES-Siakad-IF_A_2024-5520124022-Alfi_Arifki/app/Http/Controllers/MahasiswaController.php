<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    // 1. Menampilkan daftar mahasiswa beserta nama dosen walinya
    public function index()
    {
        // 'with('dosen')' digunakan untuk memanggil relasi (Eager Loading) agar loading lebih cepat
        $mahasiswas = Mahasiswa::with('dosen')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    // 2. Form tambah mahasiswa
    public function create()
    {
        // Kita butuh data dosen untuk ditampilkan di dropdown pilihan 'Dosen Wali'
        $dosens = Dosen::all();
        return view('mahasiswa.create', compact('dosens'));
    }

    // 3. Menyimpan data mahasiswa DAN membuatkan akun login
    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|size:10|unique:mahasiswas,npm',
            'nidn' => 'required|exists:dosens,nidn', // Pastikan dosen yang dipilih benar-benar ada
            'nama' => 'required|string|max:50',
        ]);

        // Simpan ke tabel mahasiswas
        Mahasiswa::create($request->all());

        // Otomatis buatkan akun login di tabel users
        User::create([
            'name' => $request->nama,
            'email' => $request->npm . '@siakad.com', // Email otomatis format: npm@siakad.com
            'password' => Hash::make('password'), // Password default: password
            'role' => 'mahasiswa',
            'npm' => $request->npm
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan dan Akun Login otomatis dibuat (Email: '.$request->npm.'@siakad.com | Pass: password).');
    }

    // 4. Form edit data mahasiswa
    public function edit($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = Dosen::all(); // Tetap butuh data dosen untuk dropdown
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    // 5. Update data mahasiswa
    public function update(Request $request, $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);

        $request->validate([
            'nidn' => 'required|exists:dosens,nidn',
            'nama' => 'required|string|max:50',
        ]);

        // Update data profil mahasiswa
        $mahasiswa->update([
            'nidn' => $request->nidn,
            'nama' => $request->nama
        ]);

        // Update juga nama di tabel users jika namanya diganti
        $user = User::where('npm', $npm)->first();
        if($user) {
            $user->update(['name' => $request->nama]);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    // 6. Hapus mahasiswa (beserta akun loginnya)
    public function destroy($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        
        // Cari akun user terkait dan hapus dulu
        $user = User::where('npm', $npm)->first();
        if($user) {
            $user->delete();
        }

        // Baru hapus data mahasiswanya
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa beserta Akun Loginnya berhasil dihapus!');
    }
}