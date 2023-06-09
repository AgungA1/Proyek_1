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
        Schema::create('staf_gudang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gudang');
            $table->string('username');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->string('avatar')->default('default.png');
            $table->string('password');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staf');
    }
};
