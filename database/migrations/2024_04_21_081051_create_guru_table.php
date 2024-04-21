
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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama_guru', 30);
            $table->string('notelp', 15);
            $table->enum('jk', ['L', 'P']);
            $table->text('alamat');
            $table->enum('agama', ['Islam', 'Hindu', 'Buddha', 'Katolik', 'Protestan', 'Lainnya']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
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
        Schema::dropIfExists('guru');
    }
};
