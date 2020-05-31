<?php

namespace App\Http\Controllers;

use App\Prenda;
use App\Vendedora;
use App\Venta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas/index', compact('ventas'));
    }

    public function indexResumen(){
        return view('ventas/resumen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'prendas'   => 'required'
        ]);

        //return gettype($request->prendas);
        foreach ($request->prendas as $prenda){
            $venta = new Venta();
            $venta->fecha_venta = Carbon::now();
            $venta->monto_venta = Prenda::where('id',$prenda)->value('precio_venta');
            $venta->vendedora_id = Prenda::where('id',$prenda)->value('vendedora_id');
            $venta->prenda_id = $prenda;
            $venta->save();
            Prenda::where('id',$prenda)->update(['vendida'=>1]);
        }
        
        return redirect(route('home'))->with('success', 'Venta realizada');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function consultarResumen(Request $request)
    {
        $desde = date($request->get('desde'));
        $hasta = date($request->get('hasta'));

        $ventas = Venta::whereBetween('fecha_venta', [$desde, $hasta])->get();

        $vendedoras = Vendedora::all();

        $arrayRetorno = [];

        foreach($vendedoras as $vendedora){
            $prendasVendidas =[];
            $montoOriginal = 0;
            $montoVenta = 0;
            $montoNeto = 0;
            foreach ($ventas as $venta){
                if ($venta->vendedora_id == $vendedora->id){
                    $prenda = Prenda::where('id',$venta->prenda_id)->first();
                    array_push($prendasVendidas,$prenda->detalle." ".$prenda->color."(".$prenda->id.")");

                    $montoOriginal += $prenda->precio_original;

                    $montoVenta += $prenda->precio_venta;

                    $montoNeto += (($prenda->precio_venta)-($prenda->precio_original));
                    
                unset($ventas[$venta->id]);
                }
                
            }
            array_push($arrayRetorno,[$vendedora->nombre." ".$vendedora->apellido,
                            $prendasVendidas,
                            $montoOriginal,
                            $montoVenta,
                            $montoNeto
                ]);
        }

        /*
        Array retorno
            vendedora
            prendas vendidas
            precio original totol
            precio venta total
            precio venta neto

        */
        return json_encode($arrayRetorno);
    }
}
