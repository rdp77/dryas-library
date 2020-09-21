<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Penerbit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_penerbit', function (Blueprint $table) {
            $table->integer('mpn_id');
            $table->string('mpn_alamat')->nullable();
            $table->string('mpn_name');
            $table->string('mpn_tlp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_penerbit');
    }
}
