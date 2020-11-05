@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Gastos Diarios</h1><br>
{{-- CSS para las notificaciones --}}
@if (Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
@endif


{{-- CSS para las notificaciones de error --}}
@if (Session::has('MensajeError'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('MensajeError') }}
    </div>
@endif

<a href="{{ url('gastods/create') }} " class="btn btn-success">Agregar Nuevo Gasto</a>
<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Area de Gasto</th>
            <th>Descripcion</th>
            <th>Costo Q.</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($gastods as $gastod)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $gastod->gastos->area_gastos }}</td>
                <td style="vertical-align: middle">{{ $gastod->descripcion_gastos }}</td>
                <td style="vertical-align: middle">{{ $gastod->costo }}</td>
                
             
                <td style="vertical-align: middle">
                    <a class="btn btn-warning" href="{{ url('/gastods/'.Crypt::encrypt($gastod->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/gastods/'.$gastod->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $gastods->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection