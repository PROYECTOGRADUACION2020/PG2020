<div class="formdiv">

    @if (strpos(url()->current(), 'edit'))
    <h2>Modificación de Pago:</h2>
    @else
    <h2>Creación de Pago:</h2>
    @endif
    <br>
        
    <div class="form-group">
        <label for="descripcion_pago" class="control-label">{{ 'Metodo de Pago' }}</label>
        <input type="text" class="form-control {{ $errors->has('descripcion_pago')?'is-invalid':'' }} " name="descripcion_pago" id="descripcion_pago" value="{{isset($pago->descripcion_pago) ? $pago->descripcion_pago:old('descripcion_pago')}}">
        {!! $errors->first('descripcion_pago', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    
   
    
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">
    
    <a href="{{ url('pagos') }}" class="btn btn-primary">Regresar</a>
    
    
    
    </div>