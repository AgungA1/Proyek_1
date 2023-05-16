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
        Schema::create('estimator', function (Blueprint $table) {
            $table->id();
            $table->string('username_estimator');
            $table->string('nama_estimator');
            $table->string('email_estimator')->unique();
            $table->string('no_telp_estimator');
            $table->string('avatar_estimator');
            $table->string('password_estimator');
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
        Schema::dropIfExists('estimator');
    }
};
