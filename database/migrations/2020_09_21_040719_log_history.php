<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_history', function (Blueprint $table) {
            $table->integer('log_id');
            $table->string('log_name')->nullable();
            $table->string('log_kode')->nullable();
            $table->string('log_feature')->nullable();
            $table->string('log_action')->nullable();
            $table->timestamp('log_created_at')->nullable();
            $table->integer('log_created_by')->nullable();
            $table->integer('log_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_history');
    }
}
