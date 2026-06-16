<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika nama tabel Anda di database bukan "jemaats"
    // protected $table = 'jemaat'; 

    // WAJIB: Daftarkan semua kolom yang ada di form input Anda
    protected $fillable = [
        'nama_jemaat',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'status',
    ];
}