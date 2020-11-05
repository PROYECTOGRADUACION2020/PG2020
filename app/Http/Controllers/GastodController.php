<?php

namespace App\Http\Controllers;

use App\gastod;
use App\gasto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GastodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['gastods']=Gastod::paginate(10);
        return view('gastods.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gastos = Gasto::all();
        return view('gastods.create', compact('gastos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [

            'id_gasto' => 'required|numeric',
            'descripcion_gastos' => 'required|string|max:45',
            'costo' => 'required|numeric',
    
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosGastod = request()->except('_token');


        try{
            Gastod::insert($datosGastod);
            return redirect('gastods')->with('Mensaje', 'El gasto se agregado con éxito');
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
        $gastods = Gastod::findOrFail($id);
        $gastods->gastos;

        // dd($organizacion->paises);
        $gastos = Gasto::orderBy('area_gasto', 'DESC')->pluck('area_gasto', 'id');

        return view('gastods.edit')
            ->with('gastos', $gastos)
            ->with('gastod', $gastods);
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

            'id_gasto' => 'required|numeric',
            'descripcion_gastos' => 'required|string|max:45',
            'costo' => 'required|numeric',
    
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosGastod = request()->except(['_token', '_method']);


        try{
           
            Gastod::where('id', '=', $id)->update($datosGastod);
            return redirect('gastods')->with('Mensaje', 'El gasto se ha modificado exitosamente');
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
            Gastod::destroy($id);
            return redirect('gastods')->with('Mensaje', 'El gasto se ha eliminado con éxito');
        }catch(QueryException $e){
            return redirect('gastods')->with('MensajeError', 'El gasto que desea eliminar ya tiene registros asociados');
        }
    }
}
