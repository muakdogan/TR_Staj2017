<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlanMallarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('ilan_mallar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ilan_id')->unsigned();
            $table->foreign('ilan_id')->references('id')->on('ilanlar')->onDelete('cascade');
            $table->string('marka');
            $table->string('model');
            $table->string('adi');
            $table->string('ambalaj');
            $table->string('miktar');
            $table->integer('birim_id')->unsigned();
            $table->foreign('birim_id')->references('id')->on('birimler')->onDelete('cascade');
            
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
        Schema::drop('ilan_mallar');
    }
}
