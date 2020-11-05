<div class="formdiv">

    @if (strpos(url()->current(), 'edit'))
    <h2>Modificación de una categoria:</h2>
    @else
    <h2>Creación de un nueva categoria:</h2>
    @endif
    <br>
        
    <div class="form-group">
        <label for="descripcion_categoria" class="control-label">{{ 'Descripción de la Categoria' }}</label>
        <input type="text" class="form-control {{ $errors->has('descripcion_categoria')?'is-invalid':'' }} " name="descripcion_categoria" id="descripcion_categoria" value="{{isset($categoria->descripcion_categoria) ? $categoria->descripcion_categoria:old('descripcion_categoria')}}">
        {!! $errors->first('descripcion_categoria', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    
   
    
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">
    
    <a href="{{ url('categorias') }}" class="btn btn-primary">Regresar</a>
    
    
    
    </div>