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
        Schema::create('jadwal_ibadahs', function (Blueprint $table) {
            // Menggunakan id_ibadah sebagai Primary Key (Sesuai gambar)
            $table->id('id_ibadah'); 
            
            // Kolom-kolom sesuai tipe data di Class Diagram
            $table->string('tema');
            $table->string('pelayan');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('tempat');
            $table->text('keterangan');
            
            $table->timestamps(); // create_at & updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadahs');
    }
};