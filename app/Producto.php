<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{


     protected $fillable = [
    	'id_categoria',
        'descripcion_producto',
        'precio_producto',
        'flag_producto',
    ];

    protected $table = 'productos';

    public function categorias(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function ingreso(){
        return $this->hasMany(Ingreso::class);
    }

  

}
