<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Venta;

class ReporteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    } 
    
    public function reporteFacturas(){
        $facturas = Factura::paginate(100);
        return view('reporterias.facturas', compact('facturas'));
    }
    

    public function reporteFacturasPDF(){
        $facturas = Factura::paginate(100);
        $pdf = \PDF::loadView('reporterias.facturasPDF', ['facturas' => $facturas]);
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }


    public function reporteVentas(){
        $ventas = Venta::paginate(100);
        return view('reporterias.ventas', compact('ventas'));
    }
    

    public function reporteVentasPDF(){
        $ventas = Venta::paginate(100);
        $pdfventas = \PDF::loadView('reporterias.ventasPDF', ['ventas' => $ventas]);
        $pdfventas->setPaper('legal', 'landscape');
        return $pdfventas->stream();
    }
}
