<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpPotongan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_potongan', function (Blueprint $table) {
            $table->increments('id');
            $table->float('kasbon');
            $table->float('angs');
            $table->float('simwa');
            $table->float('bpjs');
            $table->float('arisan');
            $table->float('zis');
            $table->float('lin');
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
        Schema::drop('tmp_potongan');
    }
}
