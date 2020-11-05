<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('dpi');  
            $table->text('nombre_persona',45);
            $table->text('apellido_persona',45);        
            $table->text('direccion',100);
            $table->bigInteger('nit');
            $table->bigInteger('telefono');     
            $table->text('correo_electronico',45);
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
        Schema::dropIfExists('personas');
    }
}
