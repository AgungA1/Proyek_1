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
        Schema::table('request_admin', function (Blueprint $table) {        
            $table->foreign('kode_barang')->references('id')->on('barang');
            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_admin', function (Blueprint $table) {        
            $table->dropForeign('kode_barang');
            $table->dropForeign('id_kategori');
        });
    }
};
