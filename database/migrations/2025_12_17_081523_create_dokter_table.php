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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser'); // Foreign Key ke tabel user
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('bidang_dokter');
            $table->string('jenis_kelamin', 1); // Enum/Varchar(1)
            $table->timestamps();

            $table->foreign('iduser')->references('iduser')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
