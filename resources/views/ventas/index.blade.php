@extends('layouts.app')
@section('title')
<title>Ventas realizadas</title>
@endsection
@section('content')

<div class="card">
    <div class="card-header">Ventas realizadas
    </div>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th scope="col">Vendedora</th>
                    <th scope="col">Prenda</th>
                    <th scope="col">Fecha venta</th>
                    <th scope="col">Monto venta</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td class="text-left">{{$venta->vendedora->nombre}} {{$venta->vendedora->apellido}}</td>
                    <td>
                        @foreach ($venta->prendas as $prenda)
                        <span class="badge badge-light">{{$prenda->detalle}} {{$prenda->color}}</span>
                        @endforeach
                    </td>
                    <td class="text-right">{{$venta->fecha_venta}}</td>
                    <td class="text-right">${{$venta->monto_venta}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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



    @endsection

    @push('scripts')
    <script>
        $(document).on('click', '.destroy', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('ventas.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
    
    </script>
    @endpush