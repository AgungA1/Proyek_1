<?php

use Brick\Math\BigInteger;
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
        Schema::create('request_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_barang');
            $table->string('nama_barang')->nullable();
            $table->integer('kuantitas_barang')->nullable();
            $table->string('jenis_request');
            $table->string('status_request');
            $table->boolean('status_penyelesaian')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_admin');
    }
};
