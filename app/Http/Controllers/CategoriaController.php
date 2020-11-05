<?php

namespace App\Http\Controllers;

use App\categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['categorias']=categoria::paginate(10);
        return view('categorias.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');

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
            'descripcion_categoria' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosCategoria = request()->except('_token');

        try{
            Categoria::insert($datosCategoria);
            return redirect('categorias')->with('Mensaje', 'Categoria agregada correctamente');
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
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));

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
            'descripcion_categoria' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosCategoria = request()->except(['_token', '_method']);

        try{
            Categoria::where('id', '=', $id)->update($datosCategoria);
            return redirect('categorias')->with('Mensaje', 'Categoria modificada exitosamente');
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
            Categoria::destroy($id);
            return redirect('categorias')->with('Mensaje', 'Categoria eliminada exitosamente');
        }catch(QueryException $e){
            return redirect('categorias')->with('MensajeError', 'La categoria que desea eliminar ya tiene registros asociados.');
        }
  
    }
}
