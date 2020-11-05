<?php

namespace App\Http\Controllers;

use App\persona;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        /*$buscarpor=$request->get('buscarpor');
        $datos['personas']=persona::paginate(10)->where('nombre_persona','like','%'.$buscarpor.'%');
         return view('personas.index', $datos, compact('persona','buscarpor'));            */


       // where('nit','like','%'.$buscarpor.'%');
        
      $datos['personas']=persona::paginate(10);
       return view('personas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personas.create');
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
         'dpi' => 'required|numeric',             
         'nombre_persona' => 'required|string|max:45',             
         'apellido_persona' => 'required|string|max:45',             
         'direccion' => 'required|string|max:100',
         'nit' => 'required|numeric',                  
         'telefono' => 'required|numeric',  
         'correo_electronico' => 'required|string|max:45',                       
                      
        ]; 
        $Mensaje=["required" => 'El campo :attribute es requerido']; 
        $this->validate($request, $campos, $Mensaje);          
        $datosPersona = request()->except('_token');          
        try{             
            Persona::insert($datosPersona);
            return redirect('personas')->with('Mensaje', 'Persona agregada con éxito');         
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
        $persona = Persona::findOrFail($id);                
        return view('personas.edit', compact('persona'));            


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
            'dpi' => 'required|numeric',             
            'nombre_persona' => 'required|string|max:45',             
            'apellido_persona' => 'required|string|max:45',             
            'direccion' => 'required|string|max:100', 
            'nit' => 'required|numeric',                
            'telefono' => 'required|numeric',                        
            'correo_electronico' => 'required|string|max:45',                
        ];          
        $Mensaje=["required" => 'El campo :attribute es requerido'];         
        $this->validate($request, $campos, $Mensaje);          
        $datosPersona = request()->except(['_token', '_method']);          
        try{             
            Persona::where('id', '=', $id)->update($datosPersona);             
            return redirect('personas')->with('Mensaje', 'Persona modificada con éxito');         
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
            Persona::destroy($id);             
            return redirect('personas')->with('Mensaje', 'Dato eliminado con éxito');
        }catch(QueryException $e){
            return redirect('personas')->with('MensajeError', 'Ha ocurrido un error');
        }

    }
}
