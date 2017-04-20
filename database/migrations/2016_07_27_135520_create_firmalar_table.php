<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmalarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmalar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('adi', 255);
            $table->string('logo');
            $table->text('tanitim_yazisi');
            $table->date('kurulus_tarihi');
            $table->string('bilgilendirme_tercihi');
            $table->integer('sirket_turu')->unsigned();
           
            $table->string('onay');
            $table->foreign('sirket_turu')->references('id')->on('sirket_turleri')->onDelete('cascade');
            $table->date('olusturmaTarihi');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('firmalar');
    }
}
