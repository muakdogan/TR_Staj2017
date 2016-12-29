<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuanlamalarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('puanlamalar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->integer('ilan_id')->unsigned();
            $table->foreign('ilan_id')->references('id')->on('ilanlar')->onDelete('cascade');
            $table->integer('yorum_yapan_firma_id')->unsigned();
            $table->foreign('yorum_yapan_firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->integer('yorum_yapan_kullanici_id')->unsigned();
            $table->foreign('yorum_yapan_kullanici_id')->references('id')->on('kullanicilar')->onDelete('cascade');
            $table->string('kriter1');
            $table->string('kriter2');
            $table->string('kriter3');
            $table->string('kriter4');
            $table->date('tarih');
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
    }
}
