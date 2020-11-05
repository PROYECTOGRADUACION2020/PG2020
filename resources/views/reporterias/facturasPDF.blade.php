<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
                       
           
        <div>
            
            <h1 style="margin-left: 500px; font-family: Arial, Helvetica, sans-serif; margin-top: 26px">Facturas</h1>
        </div>
<br><br>
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

    
</body>
</html>