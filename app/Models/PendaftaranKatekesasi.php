<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKatekesasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara manual
    protected $table = 'pendaftaran_katekesasis';

    // Mendeklarasikan id_katekesasi sebagai Primary Key kustom
    protected $primaryKey = 'id_kesasi';

    // Kolom yang diizinkan untuk pengisian massal
    protected $fillable = [
        'nama_lengkap',
        'katekesasi',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_ayah',
        'nama_ibu',
        'telepon',
        'status_verifikasi',
    ];
}