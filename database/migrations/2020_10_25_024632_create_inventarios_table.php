<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->integer('id');            
            $table->integer('id_producto', false, true)->unsigned();            
            $table->integer('id_ingreso', false, true)->unsigned();           
            $table->integer('existencia');           
            $table->timestamps();      
                        
                    $table->foreign('id_producto')                  
                       ->references('id')                   
                         ->on('productos')                    
                          ->onDelete('cascade');   
                          
                          
                           $table->foreign('id_ingreso')               
                                 ->references('id')                   
                                   ->on('ingresos')
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
        Schema::dropIfExists('inventarios');
    }
}
