
@extends('alte')

@section('content')

<div style="padding: 25px">
    {{-- CSS para las notificaciones de error --}}
    @if (Session::has('MensajeError'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('MensajeError') }}
    </div>
    @endif

<div style="padding: 25px">

@if (count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
<form action="{{ url('/productos') }}" class="form-horizontal" method="POST">
    {{ csrf_field() }}
    @include('productos.form', ['Modo'=>'crear'])
</form>
</div>
@endsection