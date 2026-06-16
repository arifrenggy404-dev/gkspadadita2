<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WartaMimbar extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara manual
    protected $table = 'warta_mimbars';

    // Mendeklarasikan id_warta sebagai Primary Key kustom (Sesuai gambar)
    protected $primaryKey = 'id_warta';

    // Kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'judul',
        'isi_warta',
        'file',
        'tanggal_terbit',
    ];
}