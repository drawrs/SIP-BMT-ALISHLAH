<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('jabatan_id');
            $table->integer('cabang_id');
            $table->string('ktp');
            $table->string('nama');
            $table->enum('jk', ['L','P']);
            $table->date('tgl');
            $table->text('alamat');
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
        Schema::drop('user_detail');
    }
}
