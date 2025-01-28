<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('npm')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};