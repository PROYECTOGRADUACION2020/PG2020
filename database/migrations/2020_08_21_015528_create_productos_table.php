<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria', false, true)->unsigned();
            $table->text('descripcion_producto',45);
            $table->decimal('precio_producto', 8, 2);
            $table->boolean('flag_producto');
              
            $table->timestamps();

            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('categorias')
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
        Schema::dropIfExists('productos');
    }
}
