@extends('layouts.app')
@section('title')
    <title>Prendas</title>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">Prendas
            <a class="btn btn-primary btn-sm float-right text-white" href="{{route('prendas.create')}}">Nuevo</a>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Color</th>
                        <th scope="col">P. Original</th>
                        <th scope="col">P. Venta</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Vendedora</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prendas as $prenda)
                    <tr>
                        <td class="text-right">{{$prenda->id}}</td>
                        <td>{{$prenda->detalle}}</td>
                        <td>{{$prenda->color}}</td>
                        <td class="text-right">${{$prenda->precio_original}}</td>
                        <td class="text-right">${{$prenda->precio_venta}}</td>
                        <td>{{$prenda->genero}}</td>
                        
                        <td>{{$prenda->vendedora->nombre}}, {{$prenda->vendedora->apellido}}</td>
                        @if ($prenda->vendida == 1)
                            <td><span class="badge badge-pill badge-danger">Vendida</span></td>
                        @else
                            <td><span class="badge badge-pill badge-success">Disponible</span></td>
                        @endif
                        <td class="text-right">
                            <a class="btn btn-light btn-sm"
                                href="{{route('prendas.edit', $prenda->id)}}"><i class="fas fa-edit"></i></a>
                            {{-- href="{{route('modulos.edit', )}}" --}}
                            <a class="btn btn-danger btn-sm text-white destroy" val-palabra={{$prenda->id}}><i class="far fa-trash-alt"></i></a>
                            {{-- href="{{route('modulos.destroy')}}" --}}
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
                <h2 class="modal-title">Eliminar prenda</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Esta seguro que desea eliminar la prenda?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- Paso el id de la materia  aborrar en materia_delete--}}
                    <button type="submit" name="ok_delete" id="ok_delete" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
    $(document).on('click', '.destroy', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('prendas.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
    
</script>
@endpush