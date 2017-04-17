<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmaCalismaBilgileriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firma_calisma_bilgileri', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->integer('calisma_gunleri_id')->unsigned();
            $table->foreign('calisma_gunleri_id')->references('id')->on('calisma_gunleri')->onDelete('cascade');
            $table->string('calisma_saatleri');
            $table->integer('calisan_profili');
            $table->string('calisan_sayisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('firma_calisma_bilgileri');
    }
}
