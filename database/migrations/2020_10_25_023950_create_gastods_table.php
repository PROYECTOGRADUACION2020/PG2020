<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gasto', false, true)->unsigned();
            $table->text('descripcion_gastos',45);
            $table->decimal('costo', 8, 2);
        
              
            $table->timestamps();

            $table->foreign('id_gasto')
                    ->references('id')
                    ->on('gastos')
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
        Schema::dropIfExists('gastods');
    }
}
