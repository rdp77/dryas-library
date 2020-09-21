<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peminjaman', function (Blueprint $table) {
            $table->integer('tpj_id');
            $table->string('tpj_kode');
            $table->integer('tpj_anggota')->nullable();
            $table->integer('tpj_staff');
            $table->date('tpj_date_pinjam');
            $table->date('tpj_date_kembali');
            $table->string('tpj_created_by');
            $table->timestamp('tpj_created_at');
            $table->date('tpj_date_tempo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_peminjaman');
    }
}
