<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlanHizmetlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ilan_hizmetler', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ilan_id')->unsigned();
            $table->foreign('ilan_id')->references('id')->on('ilanlar')->onDelete('cascade');
           
            $table->string('adi');
            $table->string('fiyat_standardi');
            $table->integer('fiyat_standardi_birim_id')->unsigned();
            $table->foreign('fiyat_standardi_birim_id')->references('id')->on('birimler')->onDelete('cascade');
            $table->string('miktar');
            $table->integer('miktar_birim_id')->unsigned();
            $table->foreign('miktar_birim_id')->references('id')->on('birimler')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('ilan_hizmetler');
    }
}
