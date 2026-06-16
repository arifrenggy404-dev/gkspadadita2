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
        Schema::create('warta_mimbars', function (Blueprint $table) {
            // Menggunakan id_warta sebagai Primary Key (Sesuai gambar)
            $table->id('id_warta'); 
            
            // Kolom-kolom sesuai tipe data di Class Diagram
            $table->string('judul');
            $table->text('isi_warta');
            $table->string('file');
            $table->date('tanggal_terbit');
            
            $table->timestamps(); // created_at & updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warta_mimbars');
    }
};