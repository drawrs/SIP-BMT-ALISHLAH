<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemptCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('kode');
            $table->string('qty');
            $table->string('from');
            $table->string('to');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('temp_cuti');
    }
}
