<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\Producto;
use App\Inventario;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['ingresos']=Ingreso::paginate(10);
        return view('ingresos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        return view('ingresos.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       /* $idInventario=$request->id_producto;
            $idProducto=$request->id_producto;
            $cantidadMas=$request->cantidad;


            $inv = [

                    'id' => $idInventario,
                    'id_producto' => $idProducto,
                    'existencia' => $cantidadMas,

            ];

            try{
                Inventario::insert($inv);
            }catch(QueryException $e){
                return back()->withInput()->with('MensajeError', 'El valor no es válido');
            }*/

         $campos = [

            'id_producto' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'descripcion_ingreso' => 'required|string|max:45',
    
         ];
  

         $Mensaje=["required" => 'El campo :attribute es requerido'];
         $this->validate($request, $campos, $Mensaje);

         $datosIngreso = request()->except('_token');


         try{
            Ingreso::insert($datosIngreso);

            return redirect('ingresos')->with('Mensaje', 'El Ingreso se agregado con éxito');
         }catch(QueryException $e){
            return back()->withInput()->with('MensajeError', 'El valor no es válido');
        }
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
       $id =  Crypt::decrypt($id);
        $ingresos = Ingreso::findOrFail($id);
        $ingresos->ingresos;

        // dd($organizacion->paises);
        $productos = Producto::orderBy('descripcion_producto', 'DESC')->pluck('descripcion_producto', 'id');

        return view('ingresos.edit')
            ->with('productos', $productos)
            ->with('ingreso', $ingresos);
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
        $campos = [
            'id_producto' => 'required|numeric',
            'descripcion_ingreso' => 'required|string|max:45',

        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosIngreso = request()->except(['_token', '_method']);

        try{
           
            Producto::where('id', '=', $id)->update($datosIngreso);
            return redirect('ingresos')->with('Mensaje', 'El Ingreso se ha modificado exitosamente');
        }catch(QueryException $e){
            return back()->withInput()->with('MensajeError', 'Ha ocurrido un error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Ingreso::destroy($id);
            return redirect('ingresos')->with('Mensaje', 'El Ingreso se ha eliminado con éxito');
        }catch(QueryException $e){
            return redirect('ingresos')->with('MensajeError', 'El Ingreso que desea eliminar ya tiene registros asociados');
        }
    }
}
