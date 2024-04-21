
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
        Schema::create('walas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdguru');
            $table->foreign('kdguru')->references('id')->on('guru') 
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kdkelas');
            $table->foreign('kdkelas')->references('id')->on('kelas') 
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('walas');
    }
};
