<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
