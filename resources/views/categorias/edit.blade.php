
@extends('alte')

@section('content')

<div style="padding: 25px;">
    {{-- CSS para las notificaciones de error --}}
    @if (Session::has('MensajeError'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('MensajeError') }}
    </div>
    @endif

    <div style="padding: 25px;">

<form action="{{ url('/categorias/' . $categoria->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    @include('categorias.form', ['Modo'=>'editar'])
</form>

</div>
@endsection