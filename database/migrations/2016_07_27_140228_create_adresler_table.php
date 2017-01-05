<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdreslerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresler', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->integer('il_id')->unsigned();
            $table->foreign('il_id')->references('id')->on('iller')->onDelete('cascade');
            $table->integer('ilce_id')->unsigned();
            $table->foreign('ilce_id')->references('id')->on('ilceler')->onDelete('cascade');
            $table->integer('semt_id')->unsigned();
            $table->foreign('semt_id')->references('id')->on('semtler')->onDelete('cascade');
            $table->integer('tur_id')->unsigned();
            $table->foreign('tur_id')->references('id')->on('adres_turleri')->onDelete('cascade');
            $table->string('posta_kodu');
            $table->string('adres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adresler');
    }
}
