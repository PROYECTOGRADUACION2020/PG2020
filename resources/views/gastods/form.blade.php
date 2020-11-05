<div class="formdiv">

        @if (strpos(url()->current(), 'edit'))
        <h2>Modificación :</h2>
        @else
        <h2>Creación de un gasto:</h2>
        @endif
    <br>

    {{--id_gasto--}}

    @if (strpos(url()->current(), 'edit'))
    {{-- Pruebas Select OLD --}}
    <div class="form-group">
        {!! Form::label('id_gasto', 'Gastos') !!}
        {!! Form::select('id_gasto', $gastos, $gastod->gastos->id, ['class' => 'form-control select-category', 'required']) !!}
    </div>
@else
    <div class="form-group">
        <label for="id_gasto" class="control-label">{{ 'Gastos' }}</label>
        <select name="id_gasto" id="id_gasto" class="form-control {{ $errors->has('id_gasto')?'is-invalid':'' }}">
            <option value="">-- Escoja  --</option>
            @foreach ($gastos as $gasto)
                <option value="{{$gasto['id'] }}"> {{ $gasto['area_gastos'] }}  </option>
            @endforeach
        </select>
        {!! $errors->first('id_gasto', '<div class="invalid-feedback">:message</div>') !!}
    </div>
@endif

    {{--descripcion_gastos--}}

    <div class="form-group">
        <label for="descripcion_gastos" class="control-label">{{ 'Descripcion del gasto' }}</label>
        <input type="text" class="form-control {{ $errors->has('descripcion_gastos')?'is-invalid':'' }} " name="descripcion_gastos" id="descripcion_gastos" value="{{isset($gastods->descripcion_gastos) ? $gastods->descripcion_gastos:old('descripcion_gastos')}}">
        {!! $errors->first('descripcion_gastos', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    {{--costo--}}

    <div class="form-group">
        <label for="costo" class="control-label">{{ 'Costo del gasto' }}</label>
        <input type="number" class="form-control {{ $errors->has('costo')?'is-invalid':'' }} " name="costo" id="costo" value="{{isset($gastod->costo) ? $gastod->costo:old('costo')}}">
        {!! $errors->first('costo', '<div class="invalid-feedback">:message</div>') !!}
    </div>

   

  
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear' ? 'Agregar' : 'Modificar' }}">

    <a href="{{ url('gastod') }}" class="btn btn-primary">Regresar</a>

    </div>