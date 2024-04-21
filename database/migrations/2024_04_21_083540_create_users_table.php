
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
        
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('password');
                $table->enum('level', [
                    'admin', 'walikelas', 'kakom',
                    'kesiswaan', 'bk'
                ])->default('walikelas');
                $table->boolean('aktif')->default(true);
                $table->unsignedBigInteger('kdwalas');
                $table->foreign('kdwalas')->references('id')->on('walas')->onDelete('cascade')->onUpdate('cascade');
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
