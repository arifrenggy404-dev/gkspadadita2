<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'jadwal_ibadahs';

    // Mendeklarasikan id_ibadah sebagai Primary Key kustom (Sesuai gambar)
    protected $primaryKey = 'id_ibadah';

    

    // Properti kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'tema',
        'pelayan',
        'tanggal',
        'jam',
        'tempat',
        'keterangan',
    ];
}