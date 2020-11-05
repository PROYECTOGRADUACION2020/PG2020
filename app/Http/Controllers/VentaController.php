<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DB;
use App\Persona;
use App\Factura;
use App\Producto;
use App\Venta;
use App\CobroPendiente;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //buscar valor de un producto

    public function insert(Request $request)
    {
        $facturas = new Factura;
        

        $facturas->fecha_factura=$request->ff;
        $facturas->numero_factura=$request->nf;
        $facturas->id_persona=$request->ip;
        $facturas->monto_facturado=$request->mf;


        if ($facturas->save()){

           // $cobropendientes = new CobroPendiente;

            $id = $facturas->id;
            foreach($request->descripcion_producto as $key => $v){

                $data =array(


                    'id_factura'=>$id,
                    'id_producto'=>$v,
                    'qty'=>$request->qty [$key],
                    'valor'=>$request->valor [$key],
                    'adelanto'=>$request->adelanto [$key],
                    'subtotal'=>$request->subtotal [$key],

                );

                Venta::insert($data);
    
            }

            //$cobropendientes->fecha_deuda=$request->ff;
            //$cobropendientes->id_persona=$request->ip;
            //$cobropendientes->id_factura=$facturas->id;
            //$cobropendientes->monto_anterior=$request->subtotal [];

          //  $table->decimal('monto_anterior', 8, 2);
           // $table->decimal('adelanto_pendiente', 8, 2);
            //$table->decimal('monto_pendiente', 8, 2);
            //$table->boolean('flag_deuda');

        }

       return back();
    }
    

    public function findPrice(Request $request){

        $data=Producto::select('precio_producto')->where('id',$request->id)->first();
        return response()->json($data);

    }

    
    
     public function index()
    {
        $datos['ventas']=Venta::paginate(10);
        return view('ventas.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Persona::all();
        $productos=Producto::all('descripcion_producto', 'id')->pluck('descripcion_producto','id');
        return view('ventas.info', compact(['productos','personas']));
  
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
}
