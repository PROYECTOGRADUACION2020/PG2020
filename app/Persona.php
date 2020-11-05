<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public function ventas(){
        return $this->hasMany(Venta::class);
    }

}
