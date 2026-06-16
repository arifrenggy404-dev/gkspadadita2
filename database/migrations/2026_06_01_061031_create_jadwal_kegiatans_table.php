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
        Schema::create('jadwal_kegiatans', function (Blueprint $table) {
            // Menggunakan id_kegiatan sebagai Primary Key (Sesuai gambar)
            $table->id('id_kegiatan'); 
            
            // Kolom-kolom sesuai dengan tipe data di Class Diagram
            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->text('deskripsi');
            
            $table->timestamps(); // created_at & updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kegiatans');
    }
};