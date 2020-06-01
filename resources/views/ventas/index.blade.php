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
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td class="text-left">{{$venta->vendedora->nombre}} {{$venta->vendedora->apellido}}</td>
                    <td>
                        <span class="badge badge-light">{{$venta->prenda->detalle}} {{$venta->prenda->color}}</span>
                    </td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y (h:m)')}}</td>
                    <td class="text-right">${{$venta->monto_venta}}</td>
                    <td class="text-right">
                        <a title="Anular venta" class="btn btn-danger btn-sm text-white anular" val-palabra={{$venta->id}}><i class="fas fa-times-circle"></i></a>
                    </td>
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
                <h2 class="modal-title">Anular venta</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Esta seguro que desea anular la venta?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Paso el id de la materia  aborrar en materia_delete--}}
                    <button type="submit" name="ok_delete" id="ok_delete" class="btn btn-danger">Anular</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>



    @endsection

    @push('scripts')
    <script>
        $(document).on('click', '.anular', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('ventas.anular',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Anulando...')
    });
    
    </script>
    @endpush