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
        Schema::create('catatan_kasus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdsiswa');
            $table->foreign('kdsiswa')->references('id')->on('siswa')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('kasus', 50);
            $table->binary('keterangan')->length('longBlob');
            $table->string('tindak_lanjut', 50);
            $table->enum('status_kasus', ['Penanganan Walas', 'Penanganan Kesiswaan', 'Kasus Selesai'])->default('Penanganan Walas');
            $table->enum('dampingan_bk', ['Ya', 'Tidak']);
            $table->string('semester', 100);
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
        Schema::dropIfExists('catatan_kasus');
    }
};
