<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobroPendientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobro_pendientes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_deuda');
            $table->integer('id_persona', false, true)->unsigned();
            $table->integer('id_factura', false, true)->unsigned();
            $table->decimal('monto_anterior', 8, 2);
            $table->decimal('adelanto_pendiente', 8, 2);
            $table->decimal('monto_pendiente', 8, 2);
            $table->boolean('flag_deuda');

            $table->timestamps();

            $table->foreign('id_persona')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');

            $table->foreign('id_factura')
                    ->references('id')
                    ->on('facturas')
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
        Schema::dropIfExists('cobro_pendientes');
    }
}
