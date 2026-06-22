<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Beri tahu Laravel primary key-nya apa dan tipenya string (bukan angka otomatis)
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['nidn', 'nama'];

    // Relasi: 1 Dosen punya banyak Mahasiswa (sebagai Dosen Wali)
    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }

    // Relasi: 1 Dosen punya banyak Jadwal mengajar
    public function jadwals() {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }
}