<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicariBilgilerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticari_bilgiler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->string('tic_sicil_no');
            $table->integer('tic_oda_id')->unsigned();
            $table->foreign('tic_oda_id')->references('id')->on('ticaret_odalari')->onDelete('cascade');
            $table->integer('ust_sektor_id')->unsigned();
            $table->foreign('ust_sektor_id')->references('id')->on('sektorler')->onDelete('cascade');
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
        Schema::drop('ticari_bilgiler');
    }
}
