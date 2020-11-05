<?php

namespace App\Http\Controllers;

use App\gasto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['gastos']=gasto::paginate(10);
        return view('gastos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gastos.create');
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
            'area_gastos' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosGastos = request()->except('_token');

        try{
            Gasto::insert($datosGastos);
            return redirect('gastos')->with('Mensaje', 'Area agregada correctamente');
        }catch(QueryException $e){
            return back()->withInput()->with('MensajeError', 'El valor no es válido.');
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
        $gastos = Gastos::findOrFail($id);
        return view('gastos.edit', compact('gastos'));
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
            'area_gastos' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosGatos = request()->except(['_token', '_method']);

        try{
            Gastos::where('id', '=', $id)->update($datosGastos);
            return redirect('gastos')->with('Mensaje', 'Area modificada exitosamente');
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
            Gastos::destroy($id);
            return redirect('gastos')->with('Mensaje', 'Area eliminada exitosamente');
        }catch(QueryException $e){
            return redirect('gastos')->with('MensajeError', 'El Area que desea eliminar ya tiene registros asociados.');
        }
  
    }
}
