<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengembalianDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pengembalian_dt', function (Blueprint $table) {
            $table->integer('tpgdt_id');
            $table->integer('tpgdt_dt');
            $table->string('tpgdt_isbn');
            $table->string('tpgdt_kondisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pengembalian_dt');
    }
}
