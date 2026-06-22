<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['npm', 'nidn', 'nama'];

    // Relasi: 1 Mahasiswa dimiliki/dibimbing oleh 1 Dosen
    public function dosen() {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    // Relasi: 1 Mahasiswa bisa punya banyak KRS
    public function krs() {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }
}