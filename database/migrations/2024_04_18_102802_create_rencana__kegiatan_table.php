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
        Schema::create('rencana__kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkegiatan');
            $table->unsignedBigInteger('bukti_fisik');
            $table->integer('minggu_ke')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreign('kdkegiatan')->references('id')->on('kegiatan') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bukti_fisik')->references('id')->on('kegiatan') 
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('rencana__kegiatan');
    }
};
