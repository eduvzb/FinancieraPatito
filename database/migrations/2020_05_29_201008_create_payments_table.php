<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->unsignedBigInteger('client_id');
            $table->integer('number'); //El número de pago 
            $table->decimal('amount'); //Monto correspondiente al pago
            $table->date('payment_date'); //Fecha en la que se debe de pagar 
            $table->date('receipt_date')->nullable(); //Fecha en la que se recibe el dinero
            $table->decimal('received_amount')->nullable();//Monto
            $table->boolean('paid')->default(0);
            $table->timestamps();

             //Llave foranea 
             $table->foreign('loan_id')
             ->references('id')
             ->on('loans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
