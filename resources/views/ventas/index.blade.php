@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Despliegue de ventas</h1><br>
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

<a href="{{ url('/info') }} " class="btn btn-success">Nuevo Venta</a>
<br>
<br>

<a href="{{ url('/pdf') }} " class="btn btn-success">Imprimir PDF</a>

<a href="{{ url('/pdfventas') }} " class="btn btn-success">Imprimir Recibo</a>

<input class="form-control" id="fechaInicial" name="fechaInicial"  placeholder="AA/MM/DD" value="{{ old('fechaInicial') }}" type="text"/>

<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Fecha</th>
            <th>Pendiente</th>
            <th>Cliente</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($ventas as $venta)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $venta->productos->descripcion_producto}}</td>
                <td style="vertical-align: middle">{{ date('d-m-Y', strtotime($venta->facturas->fecha_factura)) }}</td>
                <td style="vertical-align: middle">{{ $venta->subtotal }}</td>
                <td style="vertical-align: middle">{{ $venta->facturas->personas->nombre_persona }} {{ $venta->facturas->personas->apellido_persona }}</td>
                
                <td style="vertical-align: middle">
                {{--<a class="btn btn-warning" href="{{ url('/ventas/'.Crypt::encrypt($venta->id).'/edit') }} ">Editar</a> --}}
                    <form method="POST" action="{{ url('/ventas/'.$venta->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                   {{-- <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button> --}}
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $ventas->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection