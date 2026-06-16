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
        Schema::create('jadwal_pas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pelayan');
            $table->string('ayat_bacaan');
            $table->string('lokasi');
            $table->string('pendamping');
            $table->time('jam');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pas');
    }
};
