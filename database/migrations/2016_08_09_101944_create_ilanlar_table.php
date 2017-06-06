<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlanlarTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('ilanlar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('firma_id')->unsigned();
            $table->foreign('firma_id')->references('id')->on('firmalar')->onDelete('cascade');
            $table->string('firma_adi_gizli');
            $table->integer('ilan_sektor');
            $table->string('adi');
            $table->string('aciklama');
            $table->date('yayin_tarihi');
            $table->date('kapanma_tarihi');
            $table->string('ilan_turu');
            $table->string('usulu');
            $table->string('sozlesme_turu');
            $table->string('teknik_sartname');
            $table->integer('yaklasik_maliyet_id')->unsigned();
            $table->foreign('yaklasik_maliyet_id')->references('id')->on('maliyetler')->onDelete('cascade');
            $table->string('teslim_yeri_satici_firma');
            $table->integer('teslim_yeri_il_id')->unsigned();
            $table->foreign('teslim_yeri_il_id')->references('id')->on('iller')->onDelete('cascade');
            $table->integer('teslim_yeri_ilce_id')->unsigned();
            $table->foreign('teslim_yeri_ilce_id')->references('id')->on('ilceler')->onDelete('cascade');
            $table->string('isin_suresi');
            $table->date('is_baslama_tarihi');
            $table->date('is_bitis_tarihi');
            $table->integer('odeme_turu_id')->unsigned();
            $table->foreign('odeme_turu_id')->references('id')->on('odeme_turleri')->onDelete('cascade');
            $table->integer('para_birimi_id')->unsigned();
            $table->foreign('para_birimi_id')->references('id')->on('para_birimleri')->onDelete('cascade');
            $table->string('yaklasik_maliyet');
            $table->float('komisyon_miktari');
            $table->string('fiyatlandirma_sekli');
            $table->tinyInteger('goster');
            $table->tinyInteger('statu');
            $table->tinyInteger('sozlesme_onay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('ilanlar');
    }

}
