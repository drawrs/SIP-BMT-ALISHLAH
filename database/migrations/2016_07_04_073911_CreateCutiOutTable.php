<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCutiOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti_out', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('kode');
            $table->string('qty');
            $table->string('from');
            $table->string('to');
            $table->string('note');
            $table->enum('status', ['3','2','1', '0'])->default('3');
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
        Schema::drop('cuti_out');
    }
}
