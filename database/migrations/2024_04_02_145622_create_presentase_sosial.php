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
        Schema::create('presentase_sosial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdsiswa');
            $table->foreign('kdsiswa')->references('id')->on('siswa') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('pekerjaan_ortu',100);
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
        Schema::dropIfExists('presentase_sosial');
    }
};
