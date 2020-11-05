<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastod extends Model
{
    public function gastos(){
        return $this->belongsTo(Gasto::class, 'id_gasto');
    }
}
