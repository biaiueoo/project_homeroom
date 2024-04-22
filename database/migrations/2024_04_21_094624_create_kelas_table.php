<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('guru_nip'); // Tambahkan kolom untuk menyimpan NIP guru
            $table->foreign('guru_nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->unsignedBigInteger('kdkompetensi');
            $table->foreign('kdkompetensi')->references('id')->on('kompetensi_keahlian')->onDelete('cascade');
            $table->string('tahun_ajaran', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};
