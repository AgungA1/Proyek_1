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
        Schema::create('barang_gudang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_barang');
            $table->unsignedBigInteger('id_gudang');
            $table->integer('kuantitas_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_gudang');
    }
};
