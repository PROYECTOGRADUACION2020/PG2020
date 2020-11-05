@extends('alte')

@section('content')

<div style="padding: 25px;">
        <h1>Reporte de facturas</h1><br>
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
            <th>Fecha</th>
            <th>No. de Factura</th>
            <th>Cliente</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($facturas as $factura)
            <tr>
                <td style="vertical-align: middle">{{  date('d-m-Y', strtotime($factura->fecha_factura))}}</td>
                <td style="vertical-align: middle">{{ $factura->numero_factura}}</td>
                <td style="vertical-align: middle">{{ $factura->personas->nombre_persona .' '. $factura->personas->apellido_persona}}</td>
                <td style="vertical-align: middle">{{ $factura->monto_facturado}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('/reporterias/facturasPDF') }} " class="btn btn-success">Imprimir PDF</a>
{{--<a href="/reporterias/facturasPDF" target="_blank"><img src="{{ asset('storage/uploads/boleanos/pdf.png') }}" alt="" width="75" ></a>--}}
{{-- <a href="/menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}

</div>

@endsection