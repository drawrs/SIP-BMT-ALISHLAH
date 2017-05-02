<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('kantor_id');
            $table->string('qty');
            $table->enum('satuan', ['hari','bulan']);
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
        Schema::drop('cuti');
    }
}
