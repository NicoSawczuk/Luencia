@extends('layouts.app')
@section('title')
    <title>Vendedoras</title>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">Vendedoras
            <a class="btn btn-primary btn-sm float-right text-white" href="{{route('vendedoras.create')}}">Nuevo</a>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col" class="text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendedoras as $vendedora)
                    <tr>
                        <td>{{$vendedora->nombre}}</td>
                        <td>{{$vendedora->apellido}}</td>
                        <td class="text-right">
                            <a class="btn btn-light btn-sm"
                                href="{{route('vendedoras.edit', $vendedora->id)}}"><i class="fas fa-edit"></i></a>
                            {{-- href="{{route('modulos.edit', )}}" --}}
                            <a class="btn btn-danger btn-sm text-white destroy" val-palabra={{$vendedora->id}}><i class="far fa-trash-alt"></i></a>
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
</div>



@endsection

@push('scripts')
<script>
    $(document).on('click', '.destroy', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('vendedoras.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
    
</script>
@endpush