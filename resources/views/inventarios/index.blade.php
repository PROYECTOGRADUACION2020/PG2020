@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Control de Inventario</h1><br>
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


<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Existencia</th>
            <th>Opciones</th>


        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($inventarios as $inventario)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $inventario->productos->descripcion_producto }}</td> 

                <td style="vertical-align: middle">{{ $inventario->ingresos->id }}</td>
                <td style="vertical-align: middle">{{ $inventario->existencia }}</td>
                <td style="vertical-align: middle">{{ $inventario->created_at }}</td>
                <td style="vertical-align: middle">
              
                    <a class="btn btn-warning" href="{{ url('/inventarios/'.Crypt::encrypt($inventario->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/inventarios/'.$inventario->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $inventarios->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection