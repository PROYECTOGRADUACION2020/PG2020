<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Producto;

class PDFController extends Controller
{
  /* public function imprimir()
    {
      $productos = Producto::all();
      $pdf = PDF::loadView('imprimir',compact('productos'));
      return $pdf->stream('imprimir.pdf');
    }*/

    /*public function PDFproductos()
    {
      $productos = Producto::all();
      $pdf = PDF::loadView('productos', compact('productos'));
      return $pdf->stream('productos.pdf');


    }
  */
  public function PDFProductos(){

    $productos = Producto::all();
    $pdf = PDF::loadView('productos', compact('productos'));
    return $pdf->download('productos.pdf');
  }
}
