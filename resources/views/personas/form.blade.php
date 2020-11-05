<div class="formdiv">

        @if (strpos(url()->current(), 'edit'))
        <h2>Modificación de una persona:</h2>
        @else
        <h2>Creación de una nueva persona:</h2>
        @endif
    <br>

    {{--dpi--}}

    <div class="form-group">
        <label for="dpi" class="control-label">{{ 'Numero de Documento de Identificación' }}</label>
        <input type="number" class="form-control {{ $errors->has('dpi')?'is-invalid':'' }} " name="dpi" id="dpi" value="{{isset($persona->dpi) ? $persona->dpi:old('dpi')}}">
        {!! $errors->first('dpi', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--nombre_persona--}}

    <div class="form-group">
        <label for="nombre_persona" class="control-label">{{ 'Nombres' }}</label>
        <input type="text" class="form-control {{ $errors->has('nombre_persona')?'is-invalid':'' }} " name="nombre_persona" id="nombre_persona" value="{{isset($persona->nombre_persona) ? $persona->nombre_persona:old('nombre_persona')}}">
        {!! $errors->first('nombre_persona', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--apellido_persona--}}

    <div class="form-group">
        <label for="apellido_persona" class="control-label">{{ 'Apellidos' }}</label>
        <input type="text" class="form-control {{ $errors->has('apellido_persona')?'is-invalid':'' }} " name="apellido_persona" id="apellido_persona" value="{{isset($persona->apellido_persona) ? $persona->apellido_persona:old('apellido_persona')}}">
        {!! $errors->first('apellido_persona', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--direccion--}}

    <div class="form-group">
        <label for="direccion" class="control-label">{{ 'Direccion' }}</label>
        <input type="text" class="form-control {{ $errors->has('direccion')?'is-invalid':'' }} " name="direccion" id="direccion" value="{{isset($persona->direccion) ? $persona->direccion:old('direccion')}}">
        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
    </div>

        {{--nit--}}

    <div class="form-group">
        <label for="nit" class="control-label">{{ 'Numero de nit' }}</label>
        <input type="number" class="form-control {{ $errors->has('nit')?'is-invalid':'' }} " name="nit" id="nit" value="{{isset($persona->nit) ? $persona->nit:old('nit')}}">
        {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--telefono--}}

    <div class="form-group">
        <label for="telefono" class="control-label">{{ 'Teléfono' }}</label>
        <input type="number" class="form-control {{ $errors->has('telefono')?'is-invalid':'' }} " name="telefono" id="telefono" value="{{isset($persona->telefono) ? $persona->telefono:old('telefono')}}">
        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--email--}}

<div class="form-group">
    <label for="correo_electronico" class="control-label">{{ 'Correo Electronico' }}</label>
    <input type="email" class="form-control {{ $errors->has('correo_electronico')?'is-invalid':'' }} " name="correo_electronico" id="correo_electronico" value="{{isset($persona->correo_electronico) ? $persona->correo_electronico:old('correo_electronico')}}">
    {!! $errors->first('correo_electronico', '<div class="invalid-feedback">:message</div>') !!}
</div>


    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">

    <a href="{{ url('personas') }}" class="btn btn-primary">Regresar</a>

    </div>