<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->id(); // Primary key (id)
            $table->string('nama_jemaat', 255);
            $table->string('jenis_kelamin'); // Bisa diisi 'Laki-laki' / 'Perempuan' atau 'L' / 'P'
            $table->date('tanggal_lahir');
            $table->text('alamat'); // Menggunakan text karena alamat bisa panjang
            $table->string('telepon', 15);
            $table->string('status'); // Misalnya: 'Aktif', 'Pindah', 'Meninggal'
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaats');
    }
};