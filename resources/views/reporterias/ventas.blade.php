@extends('alte')

@section('content')

<div style="padding: 25px;">
        <h1>Factura Venta</h1><br>
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

<table class="table  table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
        <th>#</th>
            <th>Producto</th>
            <th>Fecha</th>
            <th>Pendiente</th>
            <th>Cliente</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
    @foreach ($ventas as $venta)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $venta->productos->descripcion_producto}}</td>
                <td style="vertical-align: middle">{{ date('d-m-Y', strtotime($venta->facturas->fecha_factura)) }}</td>
                <td style="vertical-align: middle">{{ $venta->subtotal }}</td>
                <td style="vertical-align: middle">{{ $venta->facturas->personas->nombre_persona }} {{ $venta->facturas->personas->apellido_persona }} {{ $venta->facturas->personas->nit }}</td>
                <td style="vertical-align: middle">{{ $venta->facturas->monto_facturado}}</td>           
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('/reporterias/ventasPDF') }} " class="btn btn-success">Imprimir </a>
{{--<a href="/reporterias/ventasPDF" target="_blank"><img src="{{ asset('storage/uploads/boleanos/pdf.png') }}" alt="" width="75" ></a>--}}
{{-- <a href="/menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}

</div>

@endsection