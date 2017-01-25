<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlanYapimIsleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ilan_yapim_isleri', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ilan_id')->unsigned();
            $table->foreign('ilan_id')->references('id')->on('ilanlar')->onDelete('cascade');
           
            $table->string('adi');
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
        Schema::drop('ilan_yapim_isleri');
    }
}
