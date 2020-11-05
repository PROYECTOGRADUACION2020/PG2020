<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            
            $table->increments('id');
            $table->date('fecha_factura');
            $table->bigInteger('numero_factura');
            $table->integer('id_persona', false, true)->unsigned();
            $table->decimal('monto_facturado');
            $table->timestamps();

            $table->foreign('id_persona')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
