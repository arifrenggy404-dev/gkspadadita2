<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara manual
    protected $table = 'jadwal_kegiatans';

    // Mendeklarasikan id_kegiatan sebagai Primary Key kustom (Sesuai gambar)
    protected $primaryKey = 'id_kegiatan';

    // Kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'jam',
        'lokasi',
        'deskripsi',
    ];
}