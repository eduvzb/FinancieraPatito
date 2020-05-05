<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); //Cliente
            $table->unsignedBigInteger('prestamos_id');
            $table->double('cantidad');
            $table->timestamps();

            //Foreing keys
            $table->foreign('client_id')
                ->references('id')
                ->on('client');
            
            $table->foreign('prestamos_id')
                ->references('id')
                ->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
