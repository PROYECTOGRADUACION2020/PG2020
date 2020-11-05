<div class="formdiv">

        @if (strpos(url()->current(), 'edit'))
        <h2>Modificación de un producto:</h2>
        @else
        <h2>Creación de un producto:</h2>
        @endif
    <br>

    {{--id_categoria--}}

    @if (strpos(url()->current(), 'edit'))
    {{-- Pruebas Select OLD --}}
    <div class="form-group">
        {!! Form::label('id_categoria', 'Categorias') !!}
        {!! Form::select('id_categoria', $categorias, $producto->categorias->id, ['class' => 'form-control select-category', 'required']) !!}
    </div>
@else
    <div class="form-group">
        <label for="id_categoria" class="control-label">{{ 'Categorias' }}</label>
        <select name="id_categoria" id="id_categoria" class="form-control {{ $errors->has('id_categoria')?'is-invalid':'' }}">
            <option value="">-- Escoja la categoria --</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria['id'] }}"> {{ $categoria['descripcion_categoria'] }}  </option>
            @endforeach
        </select>
        {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}
    </div>
@endif

    {{--descripcion_producto--}}

    <div class="form-group">
        <label for="descripcion_producto" class="control-label">{{ 'Descripcion del Producto' }}</label>
        <input type="text" class="form-control {{ $errors->has('descripcion_producto')?'is-invalid':'' }} " name="descripcion_producto" id="descripcion_producto" value="{{isset($producto->descripcion_producto) ? $producto->descripcion_producto:old('descripcion_producto')}}">
        {!! $errors->first('descripcion_producto', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--precio_producto--}}

    <div class="form-group">
        <label for="precio_producto" class="control-label">{{ 'Precio del Producto' }}</label>
        <input type="number" class="form-control {{ $errors->has('precio_producto')?'is-invalid':'' }} " name="precio_producto" id="precio_producto" value="{{isset($producto->precio_producto) ? $producto->precio_producto:old('precio_producto')}}">
        {!! $errors->first('precio_producto', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--flag_producto--}}

    <div class="col">
        <div class="input-group mb-2">
            <div class="form-group">
                <label for="flag_producto" >{{ 'Habilitar Categorias' }}</label>
                <input type="checkbox" name="flag_producto" value="1" id="flag_producto"
                @if (isset($producto))
                    @if (old('flag_producto', $producto->flag_producto))
                        checked
                    @endif
                @endif>
            </div>
        </div>
    </div>

  
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">

    <a href="{{ url('productos') }}" class="btn btn-primary">Regresar</a>

    </div>