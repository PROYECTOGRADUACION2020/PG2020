@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Despliegue de Factura</h1><br>
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



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>No. de Factura</th>
            <th>Fecha</th>
            <th>Credito Pendiente</th>
            <th>Cliente</th>
            <th>Monto Facturado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($facturas as $factura)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
               
                <td style="vertical-align: middle">{{ date('d-m-Y', strtotime($factura->facturas->fecha_factura)) }}</td>
                <td style="vertical-align: middle">{{ $factura->subtotal }}</td>
                <td style="vertical-align: middle">{{ $factura->facturas->personas->nombre_persona }} {{ $factura->facturas->personas->apellido_persona }}</td>
             


                <td style="vertical-align: middle">
                {{--<a class="btn btn-warning" href="{{ url('/facturas/'.Crypt::encrypt($factura->id).'/edit') }} ">Editar</a> --}}
                    <form method="POST" action="{{ url('/facturas/'.$factura->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                   {{-- <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button> --}}
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $facturas->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection