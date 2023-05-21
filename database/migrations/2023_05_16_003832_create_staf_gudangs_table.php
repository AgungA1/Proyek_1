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
        Schema::create('staf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id');
            $table->string('username_staf');
            $table->string('nama_staf');
            $table->string('email_staf')->unique();
            $table->string('no_telp_staf');
            $table->string('avatar_staf');
            $table->string('password_staf');
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
