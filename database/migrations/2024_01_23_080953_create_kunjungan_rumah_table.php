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
        Schema::create('kunjungan_rumah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkasus');
            $table->foreign('kdkasus')->references('id')->on('catatan_kasus') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('solusi',50);
            $table->string('ttd',50);
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
        Schema::dropIfExists('kunjungan_rumah');
    }
};
