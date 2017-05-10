<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKullanicilarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kullanicilar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('adi');
            $table->string('soyadi');
            $table->string('email');
            $table->string('password');
            $table->string('telefon');
            $table->rememberToken();
            $table->timestamps();
            $table->date('lastseen');
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
        Schema::drop('kullanicilar');

    }
}
