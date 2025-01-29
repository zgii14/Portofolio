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
        Schema::create('absensi_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('npm');
            $table->foreign('npm')->references('npm')->on('mahasiswas')->onDelete('cascade');
            $table->enum('keterangan', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->integer('pertemuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_mahasiswa');
    }
};