<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenTabele extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('bulan_id');
            $table->date('tgl');
            $table->time('jam_in');
            $table->time('jam_out')->nullable();
            $table->time('out_ijin')->nullable();
            $table->time('in_ijin')->nullable();
            $table->string('kt_ijin')->nullable();
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
        Schema::drop('absen');
    }
}
