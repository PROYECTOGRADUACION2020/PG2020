@extends('alte')
@section('content')
<div style="padding: 25px">
<body>
    <div class="container">
        
        <section class="panel">

            <div class="panel panel-default">
                <header>
                    <h3 text-aling="center">***GENERAR VENTAS***</h3>
                </header>
            </div>
            
            <div class="panel panel-footer">

            {!!Form::open(array('route'=>'insert','id'=>'frmsave','method'=>'post'))!!}
            
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="mf" class="control-label">{{ 'Fecha de Factura' }}</label>
                            <input type="date" class="form-control" name="ff" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="mf" class="control-label">{{ 'Numero Factura/Recibo' }}</label>
                            <input type="number" class="form-control" name="nf" placeholder="Numero de Factura/Recibo">
                        </div>
                    </div>

                    {{--id_persona--}}

    @if (strpos(url()->current(), 'edit'))
    {{-- Pruebas Select OLD --}}
    <div class="form-group">
        {!! Form::label('id_persona', 'Personas') !!}
        {!! Form::select('id_persona', $personas, $venta->personas->id, ['class' => 'form-control select-category', 'required']) !!}
    </div>
    @else
    <div class="form-group">
        
        <select name="ip" id="id_persona" class="form-control {{ $errors->has('id_persona')?'is-invalid':'' }}">
            <option value="">-- Cliente --</option>
            @foreach ($personas as $persona)
                <option value="{{$persona['id'] }}"> {{ $persona['nombre_persona'] }} {{ $persona['apellido_persona']}}  </option>
            @endforeach
        </select>
        {!! $errors->first('id_persona', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @endif

    <div>

        <a href="{{ url('personas/create') }} " class="btn btn-success">Agregar Nueva Persona</a>
    </div>

    
                    <div class="col-lg-8 col-sm-8">
                        <div class="form-group">
                          <label for="mf" class="control-label">{{ 'Monto a Facturar/Recibir' }}</label>  
                            <input readonly="readonly" type="number" class="form-control mf" name="mf" placeholder="Monto a Facturar/Recibir">
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4" >
                        {!!Form::submit('Guardar',array('class'=>'btn btn-primary'))!!}
                    </div>

                    <div class="col-lg-8 col-sm-8">
                        <div class="form-group">
                          <label for="mp" class="control-label">{{ 'Monto Pendiente de Cobro' }}</label>  
                            <input readonly="readonly" type="number" id="mp" class="form-control pendiente" name="mp" placeholder="Monto Pendiente">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <table class="table table-bordered">
                                
                                <thead>
                                 {{--<th>No.</th>--}}   
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Valor</th>
                                    <th>Adelanto</th>
                                    <th>Subtotal</th>
                                    <th style="text-align:center"><a href="#" class="addRow btn btn-primary">Más</a></th>
                                </thead>
                                <tbody>
                                    <tr>
                                       {{--<td>1</td>--}} 
                                        <td>
                                            <select class="form-control descripcion_producto" name="descripcion_producto[]" id="descripcion_producto">
                                                <option value="0" selected="true" disabled="true">Productos</option>
                                                @foreach ($productos as $key => $p)

                                                <option value="{!!$key!!}">{!!$p!!}</option>    
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="qty[]" class="form-control qty"></td>
                                        <td><input readonly="readonly" type="number" name="valor[]" class="form-control valor"></td>
                                        <td><input type="number" name="adelanto[]" class="form-control adelanto"></td>
                                        <td><input readonly="readonly" type="number" name="subtotal[]" class="form-control subtotal"></td>
                                        <td><a href="#" class="btn btn-danger remove">REMOVE</a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="boder:none"></td>
                                        <td style="boder:none"></td>
                                        <td style="boder:none"></td>
                                        
                                        <td><b class="facturacion"></td>
                                        <td><b class="total"></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            {!! Form::hidden('_token', csrf_token()) !!}
            {!!Form::close()!!}
            </div>

        </section>

    </div>
</body>

</div>
<script type="text/javascript">

$('tbody').delegate('.descripcion_producto', 'change', function () {

    var tr=$(this).parent().parent();
    var id = tr.find('.descripcion_producto').val();
    var dataId = {'id':id};
    $.ajax({

        type    : 'GET',
        url     : '{!!URL::route('findPrice')!!}',
        dataType: 'json',
        data    : dataId,
        success : function(data){

            tr.find('.valor').val(data.precio_producto);
        }     


    });

$('tbody').delegate('.descripcion_producto', 'change', function () {

var tr=$(this).parent().parent();
tr.find('.adelanto').focus();


});
    
});

//parametros para el precios

$('tbody').delegate('.qty,.valor,.adelanto,.subtotal','keyup',function(){
    var tr = $(this).parent().parent();
    var qty = tr.find('.qty').val();
    var valor = tr.find('.valor').val();
    var adelanto = tr.find('.adelanto').val();
    var subtotal = (qty * valor) - adelanto;
    tr.find('.subtotal').val(subtotal);
    total();
    facturacion();
});


function total() {

   var total = 0;
    $('.subtotal').each(function (i,e) {
        var subtotal = $(this).val()-0;
        total += subtotal;
    }) //.formatMoneY(3,',','.') + 
    $('.total').html("Pendiente Q." + total);
    $('.pendiente').val(total);
    facturacion();

};

function facturacion() {

var facturacion = 0;
 $('.adelanto').each(function (i,e) {
     var adelanto = $(this).val()-0;
     facturacion += adelanto;
 }) //.formatMoneY(3,',','.') + 
 $('.facturacion').html("Facturar Q." + facturacion);
 $('.mf').val(facturacion);

};





Number.prototype.formatMoneY = function (decPlaces, thouSeparator, decSeparator) {

    var n = this,
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSeparator = decSeparator == undefined ? "." : decSeparator,
    thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
    sign = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0 )).toFixed(decPlaces) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "")
    + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator)
    + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
     
};

$('.addRow').on('click',function(){

addRow();

});

function addRow() {

    var tr= '<tr>'+
                '<td>'+
                '<select class="form-control descripcion_producto" name="descripcion_producto[]" id="descripcion_producto">'+
                '<option value="0" selected="true" disabled="true">Productos</option>'+
                '@foreach ($productos as $key => $p)'+
                '<option value="{!!$key!!}">{!!$p!!}</option>'+
                '@endforeach'+
                '</select>'+
                '</td>'+

                '<td><input type="number" name="qty[]" class="form-control qty"></td>'+
                '<td><input readonly="readonly" type="number" name="valor[]" class="form-control valor"></td>'+
                '<td><input type="number" name="adelanto[]" class="form-control adelanto"></td>'+
                '<td><input readonly="readonly" type="number" name="subtotal[]" class="form-control subtotal"></td>'+
                '<td><a href="#" class="btn btn-danger remove">REMOVE</a></td>'+
                '</tr>';

    $('tbody').append(tr)

};

//buscar un registro

function findRow(input){

    $('tbody').delegate(input,'keydown',function(){

        var tr =$(this).parent().parent();
        number(tr.find(input));


    });

}

$( document ).on( "click", ".remove", function() {
    var x=$('tbody tr').length;

    if(x==1){

        alert('No se puede borrar el ingreso de un unico registro');

    }else{

        $(this).parent().parent().remove();
        total();

    }
    
});

</script>
    
@endsection