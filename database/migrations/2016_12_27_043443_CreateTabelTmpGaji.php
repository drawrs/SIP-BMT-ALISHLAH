<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelTmpGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_gaji_per_priode', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('tgl_priode_awal');
            $table->date('tgl_priode_akhir');
            $table->float('gaji_pokok');
            $table->float('uang_makan');
            $table->integer('jam_kerja');
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
        Schema::drop('rekap_gaji_per_priode');
    }
}
