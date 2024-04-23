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
        Schema::create('dmapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdmapel');
            $table->foreign('kdmapel')->references('id')->on('mata_pelajaran')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('mapel');
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
        Schema::dropIfExists('dmapel');
    }
};
