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
        Schema::create('struktur_', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->enum('jabatan', ['Kepala Sekolah', 'Wali Kelas', 'Ketua Kelas', 'Wakil Ketua Kelas','Bendahara Kelas', 'Sekretaris Kelas','Seksi Kebersihan', 'Seksi Perlengkapan', 'Seksi Keamanan', 'Seksi Kerohanian']);
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
        Schema::dropIfExists('struktur_');
    }
};
