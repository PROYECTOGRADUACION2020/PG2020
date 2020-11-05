@extends('alte')

@section('content')

<div style="padding: 50px; .align-content-center">
        <h1>Categorias</h1><br>
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

<a href="{{ url('categorias/create') }} " class="btn btn-success">Agregar Nuevo Categoria</a>
<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>Descripción de Categoria</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($categorias as $categoria)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $categoria->descripcion_categoria }}</td>
                <td style="vertical-align: middle">
                    <a class="btn btn-warning" href="{{ url('/categorias/'.Crypt::encrypt($categoria->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/categorias/'.$categoria->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $categorias->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection