<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    // 1. Menampilkan Halaman KRS Mahasiswa
    public function index()
    {
        $npm = Auth::user()->npm;
        
        // Mengambil data KRS milik mahasiswa yang sedang login
        $krs = Krs::with('matakuliah')->where('npm', $npm)->get();
        
        // Mengambil daftar matakuliah untuk dipilih di form
        $matakuliahs = Matakuliah::all();

        // Menghitung Total SKS
        $totalSks = $krs->sum(function($item) {
            return $item->matakuliah->sks;
        });

        return view('krs.index', compact('krs', 'matakuliahs', 'totalSks'));
    }

    // 2. Mengambil Mata Kuliah (Input KRS)
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliahs,kode_matakuliah'
        ]);

        $npm = Auth::user()->npm;

        // Validasi: Cek apakah mata kuliah ini sudah diambil sebelumnya
        $sudahDiambil = Krs::where('npm', $npm)->where('kode_matakuliah', $request->kode_matakuliah)->first();
        
        if ($sudahDiambil) {
            return back()->with('error', 'Gagal! Anda sudah mengambil mata kuliah ini.');
        }

        Krs::create([
            'npm' => $npm,
            'kode_matakuliah' => $request->kode_matakuliah
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS!');
    }

    // 3. Menghapus Mata Kuliah (Drop)
    public function destroy($id)
    {
        $krs = Krs::findOrFail($id);

        // Keamanan tambahan: Pastikan mahasiswa hanya bisa menghapus KRS miliknya sendiri
        if ($krs->npm == Auth::user()->npm) {
            $krs->delete();
            return back()->with('success', 'Mata kuliah berhasil di-drop (dihapus) dari KRS!');
        }

        return back()->with('error', 'Anda tidak memiliki akses untuk menghapus data ini!');
    }

    // 4. Fitur Bonus: Export ke PDF
    public function cetakPdf()
    {
        $npm = Auth::user()->npm;
        $user = Auth::user();
        
        // Mengambil data KRS khusus mahasiswa ini beserta data Mahasiswa dan Dosen Walinya
        $krs = Krs::with(['matakuliah'])->where('npm', $npm)->get();
        $mahasiswa = \App\Models\Mahasiswa::with('dosen')->where('npm', $npm)->first();

        $totalSks = $krs->sum(function($item) {
            return $item->matakuliah->sks;
        });

        // Mengirim data ke tampilan PDF
        $pdf = Pdf::loadView('krs.pdf', compact('krs', 'user', 'mahasiswa', 'totalSks'));
        
        // Mengunduh file
        return $pdf->download('KRS_'.$npm.'.pdf');
    }
}