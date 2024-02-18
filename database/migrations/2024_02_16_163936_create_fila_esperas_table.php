<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilaEsperasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fila_esperas', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('cesto');
            $table->string('pais');
            $table->string('quantidade');
            $table->string('condicao_pagamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fila_esperas');
    }
}
