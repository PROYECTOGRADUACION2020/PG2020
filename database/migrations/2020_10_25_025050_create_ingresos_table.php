<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
           
            $table->increments('id');            
            $table->integer('id_producto', false, true)->unsigned();            
            $table->integer('cantidad');       
            $table->text('descripcion_ingreso',45);           
            $table->timestamps();      
                        
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
        Schema::dropIfExists('ingresos');
    }
}
