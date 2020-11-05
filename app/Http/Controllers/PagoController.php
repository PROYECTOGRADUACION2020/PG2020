<?php

namespace App\Http\Controllers;
use App\pago;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['pagos']=pago::paginate(10);
        return view('pagos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagos.create');
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
            'descripcion_pago' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosPago = request()->except('_token');

        try{
            Pago::insert($datosPago);
            return redirect('pagos')->with('Mensaje', 'El Metodo de Pago se Agrego Correctamente');
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
        $pago = Pago::findOrFail($id);
        return view('pagos.edit', compact('pago'));
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
            'descripcion_pago' => 'required|string|max:45'
        ];

        $Mensaje=["required" => 'El campo :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosPago = request()->except(['_token', '_method']);

        try{
            Pago::where('id', '=', $id)->update($datosPago);
            return redirect('pagos')->with('Mensaje', 'El Metodo de Pago se Agrego Correctamente');
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
            Pago::destroy($id);
            return redirect('pagos')->with('Mensaje', 'El Metodo eliminada exitosamente');
        }catch(QueryException $e){
            return redirect('pagos')->with('MensajeError', 'El Metodo que desea eliminar ya tiene registros asociados.');
        }
    }
}
