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
            $table->unsignedBigInteger('kode_barang')->nullable();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->string('nama_barang')->nullable();
            $table->integer('kuantitas_barang');
            $table->date('tanggal');
            $table->string('jenis_request');
            $table->string('status_request');
            $table->string('status_penyelesaian');
            $table->string('status_persetujuan');
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
