<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RakBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rak_buku', function (Blueprint $table) {
            $table->integer('mrb_id');
            $table->string('mrb_kode');
            $table->string('mrb_name');
            $table->string('mrb_lokasi_rak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_rak_buku');
    }
}
