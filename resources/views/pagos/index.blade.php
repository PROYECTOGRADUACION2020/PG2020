@extends('alte')

@section('content')

<div style="padding: 50px; .align-content-center">
        <h1>Matodo de Pago</h1><br>
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

<a href="{{ url('pagos/create') }} " class="btn btn-success">Agregar Metodo de Pago</a>
<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Metodo de Pago</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($pagos as $pago)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $pago->descripcion_pago }}</td>
                <td style="vertical-align: middle">
                    <a class="btn btn-warning" href="{{ url('/pagos/'.Crypt::encrypt($pago->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/pagos/'.$pago->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $pagos->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection