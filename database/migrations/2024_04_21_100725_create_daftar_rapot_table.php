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
        Schema::create('daftar_rapot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdsiswa');
            $table->foreign('kdsiswa')->references('id')->on('siswa') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('rapor', 100);
            $table->text('Dokumentasi');
            $table->string('semester',100);
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
        Schema::dropIfExists('daftar_rapot');
    }
};
