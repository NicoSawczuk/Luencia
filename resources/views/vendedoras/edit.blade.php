@extends('layouts.app')
@section('title')
    <title>Modificar vendedora</title>
@endsection
@section('content')
<div class="card">
    <div class="card-header">Editar {{$vendedora->nombre}} {{$vendedora->apellido}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('vendedoras.update', $vendedora->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="nombre" class=" col-form-label text-md-right">Nombre</label>
                    <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror"
                        name="nombre" value="{{ old('nombre') ?? $vendedora->nombre }}" placeholder="Ingrese el nombre" required>
                    @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="apellido" class=" col-form-label text-md-right">Apellido</label>
                    <input id="apellido" type="text" class="form-control  @error('apellido') is-invalid @enderror"
                        name="apellido" value="{{ old('apellido') ?? $vendedora->apellido }}" placeholder="Ingrese el apellido" required>
                    @error('apellido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    </div>
    <div class="card-footer float">
        <div class="float-right">
            <a href="{{route('vendedoras.index')}}" class="btn btn-dark"><i class="fal fa-times"></i> Cancelar </a>
            <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
        </div>
    </div>
    </form>
</div>
@endsection