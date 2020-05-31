@extends('layouts.app')
@section('title')
    <title>Resumen</title>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">Resumen de ventas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="desde" class=" col-form-label text-md-right">Desde</label>
                    <input type="date" class="form-control" id="desde">
                </div>
                <div class="form-group col-md-3">
                    <label for="hasta" class=" col-form-label text-md-right">Hasta</label>
                    <input type="date" class="form-control" id="hasta">
                </div>
                <div class="form-group col-md-2">
                    <button type="button" class="btn btn-primary" id="boton" onclick="realizarResumen()" style="margin-top: 38px;">Consultar</button>
                </div>
            </div> 
            <table id="tabla" class="table table-striped table-bordered" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Vendedora</th>
                        <th scope="col">Prendas vendidas</th>
                        <th scope="col">Total M. original</th>
                        <th scope="col">Total M. venta</th>
                        <th scope="col">Total M. neto</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
<br>

@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $("#desde").change(function () {
        var fecha = $(this).val();
        document.getElementById("hasta").min = fecha;
      });
      $("#hasta").change(function () {
        var fecha = $(this).val();
        document.getElementById("desde").max = fecha;
  
      });
    });
  </script>
<script>
    function realizarResumen(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        console.log(desde);
        console.log(hasta);
        if ((desde != '') && (hasta != '')){
            $.ajax({
            url:"{{route('ventas.consultarResumen')}}",
            method:"GET",
            dataType: 'json',
            data:{desde:desde, hasta:hasta},
            success:function(result){
                $('#tabla').css({
                    "display": "block",
                    "width": "100%"
                });
                var html = "";
                for (let i = 0; i < result.length; i++) {
                    html += '<tr>'+
                                    '<td>'+result[i][0]+'</td>'+
                                    '<td>'+result[i][1]+'</td>'+
                                    '<td><span class="badge badge-pill badge-light">$'+result[i][2]+'</span></td>'+
                                    '<td><span class="badge badge-pill badge-info">$'+result[i][3]+'</span></td>'+
                                    '<td><span class="badge badge-pill badge-success">$'+result[i][4]+'</span></td>'+
                                '</tr>'
                }
                $('#tabla tbody').html(html);
            }
        });
        }
    }
</script>
@endpush