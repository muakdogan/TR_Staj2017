<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmaReferanslarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firma_referanslar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->string('adi');
            $table->string('is_adi');
            $table->string('is_turu');
            $table->integer('is_yili');
            $table->string('calisma_suresi');
            $table->string('yetkili_adi');
            $table->string('yetkili_email');
            $table->string('yetkili_telefon');
            $table->string('ref_turu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('firma_referanslar');
    }
}
