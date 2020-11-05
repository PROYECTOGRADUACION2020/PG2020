<div class="formdiv">

    @if (strpos(url()->current(), 'edit'))
    <h2>Modificación de una Area:</h2>
    @else
    <h2>Creación de un nueva Area:</h2>
    @endif
    <br>
        
    <div class="form-group">
        <label for="area_gastos" class="control-label">{{ 'Area de Gastos' }}</label>
        <input type="text" class="form-control {{ $errors->has('area_gastos')?'is-invalid':'' }} " name="area_gastos" id="area_gastos" value="{{isset($gastos->area_gastos) ? $gastos->area_gastos:old('area_gastos')}}">
        {!! $errors->first('area_gastos', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    
   
    
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">
    
    <a href="{{ url('gastos') }}" class="btn btn-primary">Regresar</a>
    
    
    
    </div>