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
        Schema::create('jadwal_kbm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdguru');
            $table->foreign('kdguru')->references('id')->on('guru') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kdkelas');
            $table->foreign('kdkelas')->references('id')->on('kelas') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kdkompetensi');
            $table->foreign('kdkompetensi')->references('id')->on('kompetensi_keahlian') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kdmapel');
            $table->foreign('kdmapel')->references('id')->on('mata_pelajaran') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('tahun_ajaran',30);
            $table->string('semester',50);
            $table->string('jam',50);
            $table->string('hari',11);

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
        Schema::dropIfExists('jadwal_kbm');
    }
};
