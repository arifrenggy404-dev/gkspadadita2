<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_pa extends Model
{
    use HasFactory;
     protected $table = 'jadwal_pas';

    // Mendeklarasikan id_ibadah sebagai Primary Key kustom (Sesuai gambar)
    protected $primaryKey = 'id';

    // Properti kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'nama',
        'pelayan',
        'ayat_bacaan',
        'lokasi',
        'pendamping',
        'jam',
        'tanggal',
    ];
}
