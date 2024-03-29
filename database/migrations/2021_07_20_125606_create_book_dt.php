<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_dt', function (Blueprint $table) {
            $table->integer('mbdt_id');
            $table->integer('mbdt_dt');
            $table->string('mbdt_isbn')->nullable();
            $table->string('mbdt_status');
            $table->string('mbdt_rak_buku_dt');
            $table->string('mbdt_kondisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_dt');
    }
}
