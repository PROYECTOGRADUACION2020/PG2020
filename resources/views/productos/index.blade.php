@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Productos</h1><br>
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

<a href="{{ url('productos/create') }} " class="btn btn-success">Agregar Nuevo Producto</a>
<br>
<br>

<a href="{{ route('descargarPDFProductos') }} " target="_blank" class="btn btn-success">Imprimir PDF </a>
<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Categoria</th>
            <th>Producto</th>
            <th>Costo Q.</th>
            <th>Activo/Inactivo</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($productos as $producto)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $producto->categorias->descripcion_categoria }}</td>
                <td style="vertical-align: middle">{{ $producto->descripcion_producto }}</td>
                <td style="vertical-align: middle">{{ $producto->precio_producto }}</td>
                @if ($producto->flag_producto === 1)
                <td class=" btn btn-success" type=""><i class="icon fas fa-check"></i></td>
                @else
                <td class="btn btn-danger" type=""><i class="icon fas fa-ban"></i></td>
                @endif
                <td style="vertical-align: middle">
                    <a class="btn btn-warning" href="{{ url('/productos/'.Crypt::encrypt($producto->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/productos/'.$producto->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $productos->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection