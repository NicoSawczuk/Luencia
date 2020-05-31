@extends('layouts.app')
@section('title')
    <title>Modificar prenda</title>
@endsection
@section('content')
<div class="card">
    <div class="card-header">Editar {{$prenda->detalle}} {{$prenda->color}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('prendas.update',$prenda->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label for="detalle" class=" col-form-label text-md-right">Detalle</label>
                    <input id="detalle" type="text" class="form-control  @error('detalle') is-invalid @enderror"
                        name="detalle" value="{{ old('detalle') ?? $prenda->detalle }}" placeholder="Ingrese el detalle" required>
                    @error('detalle')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="color" class=" col-form-label text-md-right">Color</label>
                    <input id="color" type="text" class="form-control  @error('color') is-invalid @enderror"
                        name="color" value="{{ old('color') ?? $prenda->color }}" placeholder="Ingrese el color" required>
                    @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="precio_original" class=" col-form-label text-md-right">Precio original</label>
                    <input id="precio_original" type="number" class="form-control  @error('precio_original') is-invalid @enderror"
                        name="precio_original" value="{{ old('precio_original') ?? $prenda->precio_original }}" placeholder="Ingrese el precio original" required>
                    @error('precio_original')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="precio_venta" class=" col-form-label text-md-right">Precio venta</label>
                    <input id="precio_venta" type="number" class="form-control  @error('precio_venta') is-invalid @enderror"
                        name="precio_venta" value="{{ old('precio_venta') ?? $prenda->precio_venta }}" placeholder="Ingrese el precio de venta" required>
                    @error('precio_venta')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="vendedora" class=" col-form-label text-md-right">Vendedora</label>
                    <select class="form-control  @error('vendedora') is-invalid @enderror" rows="3" name="vendedora"
                        value="{{ old('vendedora') }}">
                        @foreach ($vendedoras as $vendedora)
                            @if ($vendedora->id == $prenda->vendedora_id)
                            <option value="{{$vendedora->id}}" selected>{{$vendedora->nombre}}</option>
                            @else
                                <option value="{{$vendedora->id}}">{{$vendedora->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('vendedora')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="genero" class=" col-form-label text-md-right">Género</label>
                    <select class="form-control  @error('genero') is-invalid @enderror" rows="3" name="genero"
                        value="{{ old('genero') ?? $prenda->genero }}">
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                    </select>
                    @error('vendedora')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    </div>
    <div class="card-footer float">
        <div class="float-right">
            <a href="{{route('prendas.index')}}" class="btn btn-dark"><i class="fal fa-times"></i> Cancelar </a>
            <button type="submit" class="btn btn-primary "><i class="fal fa-check"></i> Guardar</button>
        </div>
    </div>
    </form>
</div>
@endsection