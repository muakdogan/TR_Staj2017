<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHizmetTekliflerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hizmet_teklifler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ilan_hizmet_id')->unsigned();
            $table->foreign('ilan_hizmet_id')->references('id')->on('ilan_hizmetler')->onDelete('cascade');
            $table->string('fiyat');
            $table->integer('para_birimleri_id')->unsigned();
            $table->foreign('para_birimleri_id')->references('id')->on('para_birimleri')->onDelete('cascade');
            $table->date('tarih');
            $table->integer('firma_kullanicilar_id')->unsigned();
            $table->foreign('firma_kullanicilar_id')->references('id')->on('firma_kullanicilar')->onDelete('cascade');
            
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
        Schema::drop('hizmet_teklifler');
    }
}
