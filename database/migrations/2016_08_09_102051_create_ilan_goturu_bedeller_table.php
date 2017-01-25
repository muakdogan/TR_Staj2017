<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlanGoturuBedellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ilan_goturu_bedeller', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ilan_id')->unsigned();
            $table->foreign('ilan_id')->references('id')->on('ilanlar')->onDelete('cascade');
           
            $table->string('isin_adi');
            $table->string('miktar_turu');
           
            
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
        Schema::drop('ilan_goturu_bedeller');
    }
}
