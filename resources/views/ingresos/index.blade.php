@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Ingresos</h1><br>
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

<a href="{{ url('ingresos/create') }} " class="btn btn-success">Agregar Nuevo Ingreso</a>
<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Detalle</th>
            <th>Fecha de Ingreso</th>
            <th>Opciones</th>


        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($ingresos as $ingreso)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $ingreso->productos->descripcion_producto }}</td>
                <td style="vertical-align: middle">{{ $ingreso->cantidad }}</td>
                <td style="vertical-align: middle">{{ $ingreso->descripcion_ingreso }}</td>
                <td style="vertical-align: middle">{{ $ingreso->created_at }}</td>
                <td style="vertical-align: middle">
              
                    <a class="btn btn-warning" href="{{ url('/ingresos/'.Crypt::encrypt($ingreso->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/ingresos/'.$ingreso->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $ingresos->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection