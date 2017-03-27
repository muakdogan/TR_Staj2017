<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYorumlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('yorumlar', function (Blueprint $table) {
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
            $table->string('yorum',500);
            $table->date('tarih');
            $table->string('onay');
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
        Schema::drop('yorumlar');
    }
}
