<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public function ingresos(){
        return $this->belongsTo(Ingreso::class, 'id_ingreso');
    }

    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }

 /*   public function productos(){
        return $this->hasMany(Producto::class);
    }
    public function ventas(){
        return $this->hasMany(Venta::class);
    }*/

}
