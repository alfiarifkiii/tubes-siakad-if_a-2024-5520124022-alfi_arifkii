<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => 'password', // Di Laravel 11 otomatis dienkripsi (hashed)
            'role' => 'admin',
        ]);

        // 2. Buat Data Master Dosen
        Dosen::create([
            'nidn' => '1122334455',
            'nama' => 'Dr. Budi Santoso, M.Kom',
        ]);

        // 3. Buat Data Master Mahasiswa
        Mahasiswa::create([
            'npm' => '1002003001',
            'nidn' => '1122334455', // Relasi: Dosen walinya Pak Budi
            'nama' => 'Andi Pratama',
        ]);

        // 4. Buat Akun Login Khusus Mahasiswa tersebut
        User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@siakad.com',
            'password' => 'password',
            'role' => 'mahasiswa',
            'npm' => '1002003001', // Relasi: Tersambung ke data mahasiswa
        ]);

        // 5. Buat Data Matakuliah
        Matakuliah::create([
            'kode_matakuliah' => 'IF53413',
            'nama_matakuliah' => 'Pemrograman Web II',
            'sks' => 3,
        ]);
    }
}