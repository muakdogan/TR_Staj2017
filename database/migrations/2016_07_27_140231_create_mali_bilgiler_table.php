<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaliBilgilerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mali_bilgiler', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->string('unvani');
            $table->integer('vergi_dairesi_id')->unsigned();
            $table->foreign('vergi_dairesi_id')->references('id')->on('vergi_daireleri')->onDelete('cascade');
            $table->integer('vergi_numarasi');
            $table->string('yillik_cirosu');
            $table->boolean('ciro_goster');
            $table->string('sermayesi');
            $table->boolean('sermaye_goster');
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
        Schema::drop('mali_bilgiler');
    }
}
