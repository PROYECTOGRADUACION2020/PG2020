<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_factura', false, true)->unsigned();
            $table->integer('id_producto', false, true)->unsigned();
            
            $table->integer('qty');

            $table->decimal('valor');
            $table->decimal('adelanto');
            $table->decimal('subtotal');
            $table->timestamps();

            $table->foreign('id_factura')
                    ->references('id')
                    ->on('facturas')
                    ->onDelete('cascade');

            $table->foreign('id_producto')
                    ->references('id')
                    ->on('productos')
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
        Schema::dropIfExists('ventas');
    }
}
