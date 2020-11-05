<div class="formdiv">

        @if (strpos(url()->current(), 'edit'))
        <h2>Modificación de un ingreso:</h2>
        @else
        <h2>Nuevo ingreso:</h2>
        @endif
    <br>

    {{--id_producto--}}

    @if (strpos(url()->current(), 'edit'))
    {{-- Pruebas Select OLD --}}
    <div class="form-group">
        {!! Form::label('id_producto', 'Productos') !!}
        {!! Form::select('id_producto', $productos, $ingreso->productos->id, ['class' => 'form-control select-category', 'required']) !!}
    </div>
@else
    <div class="form-group">
        <label for="id_producto" class="control-label">{{ 'Productos' }}</label>
        <select name="id_producto" id="id_producto" class="form-control {{ $errors->has('id_producto')?'is-invalid':'' }}">
            <option value="">-- Escoja el Producto --</option>
            @foreach ($productos as $producto)
                <option value="{{$producto['id'] }}"> {{ $producto['descripcion_producto'] }}  </option>
            @endforeach
        </select>
        {!! $errors->first('id_producto', '<div class="invalid-feedback">:message</div>') !!}
    </div>
@endif

   {{--cantidad--}}

<div class="form-group">
    <label for="cantidad" class="control-label">{{ 'cantidad del Producto' }}</label>
    <input type="number" class="form-control {{ $errors->has('cantidad')?'is-invalid':'' }} " name="cantidad" id="cantidad" value="{{isset($ingreso->cantidad) ? $ingreso->cantidad:old('cantidad')}}">
    {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
</div>
    {{--descripcion_ingreso--}}

    <div class="form-group">
        <label for="descripcion_ingreso" class="control-label">{{ 'Detalle del Ingreso' }}</label>
        <input type="text" class="form-control {{ $errors->has('descripcion_ingreso')?'is-invalid':'' }} " name="descripcion_ingreso" id="descripcion_ingreso" value="{{isset($ingreso->descripcion_ingreso) ? $ingreso->descripcion_ingreso:old('descripcion_ingreso')}}">
        {!! $errors->first('descripcion_ingreso', '<div class="invalid-feedback">:message</div>') !!}
    </div>

  

  
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">

    <a href="{{ url('ingresos') }}" class="btn btn-primary">Regresar</a>

    </div>