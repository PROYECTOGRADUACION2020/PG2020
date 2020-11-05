<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public function personas(){
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    public function ventas(){
        return $this->belongsTo(Venta::class, 'id_venta');
    }


}
