<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('login', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('kullanici_id')->unsigned();
            $table->foreign('kullanici_id')->references('id')->on('kullanicilar')->onDelete('cascade');
            $table->string('kullanici_adi');
            $table->string('email');
            $table->string('sifre');
            $table->string('son_gorulme_tarihi');
            
            
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
        Schema::drop('login');
    }
}
