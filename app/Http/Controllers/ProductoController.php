<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['productos']=Producto::paginate(10);
        return view('productos.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));

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

            'id_categoria' => 'required|numeric',
            'descripcion_producto' => 'required|string|max:45',
            'precio_producto' => 'required|numeric',
    
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosProducto = request()->except('_token');

        if($request->flag_producto == 1){
            $datosProducto['flag_producto'] = 1;
        }else{
            $datosProducto['flag_producto'] = 0;
        }

        try{
            Producto::insert($datosProducto);
            return redirect('productos')->with('Mensaje', 'El Producto se agregado con éxito');
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
        $productos = Producto::findOrFail($id);
        $productos->categorias;

        // dd($organizacion->paises);
        $categorias = Categoria::orderBy('descripcion_categoria', 'DESC')->pluck('descripcion_categoria', 'id');

        return view('productos.edit')
            ->with('categorias', $categorias)
            ->with('producto', $productos);

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

            'id_categoria' => 'required|numeric',
            'descripcion_producto' => 'required|string|max:45',
            'precio_producto' => 'required|numeric',
    
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosProducto = request()->except(['_token', '_method']);

        if($request->flag_producto == 1){
            $datosProducto['flag_producto'] = 1;
        }else{
            $datosProducto['flag_producto'] = 0;
        }

        try{
           
            Producto::where('id', '=', $id)->update($datosProducto);
            return redirect('productos')->with('Mensaje', 'El Producto se ha modificado exitosamente');
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
            Producto::destroy($id);
            return redirect('productos')->with('Mensaje', 'El Producto se ha eliminado con éxito');
        }catch(QueryException $e){
            return redirect('productos')->with('MensajeError', 'El Producto que desea eliminar ya tiene registros asociados');
        }

    }
}
