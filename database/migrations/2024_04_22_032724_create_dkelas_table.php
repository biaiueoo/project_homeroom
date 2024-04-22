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
        Schema::create('dkelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkelas');
            $table->foreign('kdkelas')->references('id')->on('kelas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswa')
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
        Schema::dropIfExists('dkelas');
    }
};
