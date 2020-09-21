<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengembalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pengembalian', function (Blueprint $table) {
            $table->integer('tpg_id');
            $table->string('tpg_kode');
            $table->integer('tpg_anggota');
            $table->integer('staff');
            $table->date('tpg_date_kembali');
            $table->string('tpg_created_by');
            $table->timestamp('tpg_created_at');
            $table->integer('tpg_peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pengembalian');
    }
}
