<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    // Menentukan nama tabel kustom di database
    protected $table = 'jemaat'; 

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'nama_jemaat',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'status',
    ];
}