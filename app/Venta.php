<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function facturas(){
        return $this->belongsTo(Factura::class, 'id_factura');
    }

}
