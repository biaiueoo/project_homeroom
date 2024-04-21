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
        Schema::create('pembinaan_bk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkasus');
            $table->foreign('kdkasus')->references('id')->on('catatan_kasus')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['Kasus Baru', 'Dalam Pembinaan', 'Kasus Selesai'])->default('Kasus Baru');
            $table->text('catatan-pembinaan')->nullable();
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
        Schema::dropIfExists('pembinaan_bk');
    }
};
