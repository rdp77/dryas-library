<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->integer('mb_id');
            $table->string('mb_kode');
            $table->integer('mb_kategori');
            $table->integer('mb_penerbit')->nullable();
            $table->integer('mb_pengarang')->nullable();
            $table->string('mb_created_by');
            $table->timestamp('mb_created_at');
            $table->string('mb_name');
            $table->string('mb_desc')->nullable();
            $table->string('mb_pinjam');
            $table->string('mb_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
