@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Prendas</div>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Color</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Vendedora</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($prendas as $prenda)
                <tr>
                    <td class="text-right">{{$prenda->id}}</td>
                    <td>{{$prenda->detalle}}</td>
                    <td>{{$prenda->color}}</td>
                    <td class="text-right">${{$prenda->precio_venta}}</td>
                    <td>{{$prenda->genero}}</td>
                    <td>{{$prenda->vendedora->nombre}}, {{$prenda->vendedora->apellido}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header bg-success">Realizar una venta</div>
    <form action="{{route('ventas.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <select class="duallistbox" multiple="multiple" name="prendas[]">
                @foreach ($prendas as $prenda)
                <option value="{{$prenda->id}}">{{$prenda->id}} - {{$prenda->detalle}} {{$prenda->color}} -
                    ${{$prenda->precio_venta}}</option>
                @endforeach
            </select>
            <br>
            <div id="rowDetalle" class="row" style="display: none;">
                <div class="col-6">
                    <p class="lead">Detalle de venta</p>

                    <div class="table-responsive">
                        <table class="table" id="tablaDetalle">
                        </table>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary float-right">Finalizar venta</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<br>



<div id="confirmDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmacion</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Esta seguro que desea borrarlo?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- Paso el id de la materia  aborrar en materia_delete--}}
                    <button type="submit" name="ok_delete" id="ok_delete" class="btn btn-danger">SI Borrar</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">NO Borrar</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function(){
            
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()
    });
    </script>
    <script>
        $('.duallistbox').change(function(){
            var idPrendas = $('.duallistbox').val();
            if (idPrendas.length === 0){
                $('#tablaDetalle').html('');
                $('#rowDetalle').css({
                    "display": "none"
                });
            }else{
            $.ajax({
            url:"prendas/consultar_prenda",
            method:"GET",
            dataType: 'json',
            data:{idPrendas:idPrendas,},
            success:function(result){
                $('#rowDetalle').css({
                    "display": "block"
                });
                var html = "";
                var montoTotal = 0;
                for (let i = 0; i < result.length; i++) {
                    montoTotal += parseFloat(result[i]['precio_venta']);
                    html += '<tr>'+
                                '<th style="width:80%">'+result[i]['detalle']+' '+result[i]['color']+'</th>'+
                                '<td>$'+result[i]['precio_venta']+'</td>'+
                            '</tr>';
                }
                $('#tablaDetalle').html(html);
                var htmlTotal = '<tr class="alert alert-success">'+
                                    '<th style="width:80%">Total de venta:</th>'+
                                    '<td><b>$'+montoTotal+'</b></td>'+
                                '</tr>';
                $('#tablaDetalle').append(htmlTotal);
                
            }
        });
    }
            // montoTotal = montoTotal+montoParcial;
            // var html = '<tr>'+'<th style="width:80%">Prenda</th>'+'<td>'+montoParcial+'</td>'+'</tr>';
            // $('#tablaDetalle').append(html);

            // var htmlTotal;
            // $('#montoTotal').html(htmlTotal);
            // montoParcial = 0;
        })
    </script>
    @endpush

    @endsection