<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total data untuk statistik (Bonus Nilai Tugas)
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();

        // Mengirim data ke tampilan (view) dashboard
        return view('dashboard', compact('totalDosen', 'totalMahasiswa', 'totalMatakuliah'));
    }
}