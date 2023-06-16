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
        Schema::create('respon_staf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gudang');
            $table->unsignedBigInteger('id_request');
            $table->string('persetujuan');
            $table->string('persetujuan_admin')->nullable();
            $table->integer('kuantitas')->nullable();
            $table->foreign('id_gudang')->references('id')->on('gudang');
            $table->foreign('id_request')->references('id')->on('request_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respon_staf');
    }
};
