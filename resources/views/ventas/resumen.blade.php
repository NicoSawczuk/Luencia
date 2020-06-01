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
            <table id="tabla" class="table table-striped table-bordered table-responsive" style="display: none;">
                <thead>
                    <tr>
                        <th scope="col">Vendedora</th>
                        <th scope="col">Prendas vendidas</th>
                        <th scope="col">Total M. original</th>
                        <th scope="col">Total M. venta</th>
                        <th scope="col">Total M. neto</th>
                    </tr>
                </thead>
                <tbody style="width: 100%;">
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
                    "width": "100%",
                    "display": "block"
                    
                });
                var html = "";
                for (let i = 0; i < result.length; i++) {
                    var prendasHtml = "";
                    for (let j = 0; j < result[i][1].length; j++) {
                        prendasHtml += '<span class="badge badge-pill badge-secondary">'+result[i][1][j]+'</span> ';                        
                    }
                    html += '<tr>'+
                                    '<td style="width: 15%">'+result[i][0]+'</td>'+
                                    '<td style="width: 55%">'+prendasHtml+'</td>'+
                                    '<td style="width: 10%"><h5><b><span class="badge badge-pill badge-light">$'+result[i][2]+'</span></b></h5></td>'+
                                    '<td style="width: 10%"><h5><b><span class="badge badge-pill badge-info">$'+result[i][3]+'</span></b></h5></td>'+
                                    '<td style="width: 10%"><h5><b><span class="badge badge-pill badge-success">$'+result[i][4]+'</span></b></h5></td>'+
                                '</tr>';
                    prendasHtml = '';
                }
                $('#tabla tbody').html(html);
            }
        });
        }
    }
</script>
@endpush