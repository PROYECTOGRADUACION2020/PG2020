@extends('alte')

@section('content')

<div style="padding: 25px">
        <h1>Personas</h1><br>

        <form class="form-inline my-2 my-lg-0 float-right">
      <input name="buscarpor"class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" >
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>


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

<a href="{{ url('personas/create') }} " class="btn btn-success">Agregar Nueva Persona</a>

<br>
<br>



<table class="table table-hover">
    <thead class="thead-light" style="text-align: center;">
        <tr>
            <th>#</th>
            <th>DPI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direccion</th>
            <th>Nit</th>
            <th>Telefono</th>
            <th>Correo Electronico</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach ($personas as $persona)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">{{ $persona->dpi }}</td>
                <td style="vertical-align: middle">{{ $persona->nombre_persona }}</td>
                <td style="vertical-align: middle">{{ $persona->apellido_persona }}</td>
                <td style="vertical-align: middle">{{ $persona->direccion }}</td>
                <td style="vertical-align: middle">{{ $persona->nit }}</td>
                <td style="vertical-align: middle">{{ $persona->telefono }}</td>
                <td style="vertical-align: middle">{{ $persona->correo_electronico }}</td>
                
                <td style="vertical-align: middle">
                    <a class="btn btn-warning" href="{{ url('/personas/'.Crypt::encrypt($persona->id).'/edit') }} ">Editar</a>
                    <form method="POST" action="{{ url('/personas/'.$persona->id) }}" style="display: inline; ">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar?');">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $personas->render() !!}
{{-- <a href="menurh"><img src="{{ asset('storage/uploads/boleanos/home.png') }}" width="60" alt="" class="navbar-form pull-right"></a> --}}
</div>
@endsection