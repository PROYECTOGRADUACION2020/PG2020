<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas Ventas</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
                       
           
        <div>
            
            <h1 style="margin-left: 500px; font-family: Arial, Helvetica, sans-serif; margin-top: 26px">Facturas Ventas</h1>
        </div>
<br><br>
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

    
</body>
</html>