<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); //Cliente
            $table->double('cantidad');
            $table->integer('num_pagos');
            $table->double('cuota');
            $table->double('pago_total');
            $table->date('fecha_ministracion');
            $table->date('fecha_vencimiento');
                
            //Llave foranea 
            $table->foreign('client_id')
                ->references('id')
                ->on('client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
