
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

<form action="{{ url('/gastos/' . $gastos->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    @include('gastos.form', ['Modo'=>'editar'])
</form>

</div>
@endsection