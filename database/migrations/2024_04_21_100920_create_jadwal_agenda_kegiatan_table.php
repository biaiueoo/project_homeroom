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
        Schema::create('agenda_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkelas');
            $table->foreign('kdkelas')->references('id')->on('kelas') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kdkompetensi');
            $table->foreign('kdkompetensi')->references('id')->on('kompetensi_keahlian') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->text('dokumentasi');
            $table->string('keterangan',50);
            $table->date('tanggal');
            $table->string('waktu', 20);
            $table->string('nama_kegiatan', 20);
            $table->string('hari',11);
            $table->string('semester',50);
            $table->string('tahun_ajaran',30);
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
        Schema::dropIfExists('agenda_kegiatan');
    }
};
