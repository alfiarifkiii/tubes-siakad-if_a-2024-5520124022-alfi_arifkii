<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // Memastikan Laravel membaca tabel bernama 'krs', bukan 'krses'
    protected $table = 'krs';
    
    protected $fillable = ['npm', 'kode_matakuliah'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    public function matakuliah() {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}