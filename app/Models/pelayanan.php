<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelayanan extends Model
{
     use HasFactory;

     protected $table = 'pelayanans'; // Sesuaikan dengan nama tabel asli di database

    protected $fillable = [
        'nama',
        'status',
        'nomor_tlpn',
        'jenis_kelamin',
        'alamat',
    ];
}
