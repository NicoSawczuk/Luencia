<?php

namespace App\Http\Controllers;

use App\Prenda;
use App\Vendedora;
use Illuminate\Http\Request;

class PrendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prendas = Prenda::all();
        return view('prendas/index', compact('prendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ultimaPrenda= Prenda::all()->last();
        $ultimaVendedora = null;
        if (!is_null($ultimaPrenda)) {
            $ultimaVendedora = $ultimaPrenda->vendedora;
        }

        $vendedoras = Vendedora::all();
        return view('prendas/create', compact('vendedoras', 'ultimaVendedora'));
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
            'detalle'        => 'required|regex:/^[a-zA-Z\s]*$/',
            'color'   => 'required|regex:/^[a-zA-Z\s]*$/',
            'precio_original'   => 'required',
            'precio_venta'   => 'required',
            'genero'   => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        $prenda = new Prenda();
        $prenda->detalle = $request->detalle;
        $prenda->color = $request->color;
        $prenda->precio_original = $request->precio_original;
        $prenda->precio_venta = $request->precio_venta;
        $prenda->genero = $request->genero;
        $prenda->vendedora_id = $request->vendedora;

        $prenda->save();

        if ($prenda->save()) {
            return redirect()->back()->with('success', 'Prenda creada con éxito');
        }
        return redirect()->back()->withErrors('No se pudo crear la prenda');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prenda  $prenda
     * @return \Illuminate\Http\Response
     */
    public function show(Prenda $prenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prenda  $prenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Prenda $prenda)
    {
        $vendedoras = Vendedora::all();
        return view('prendas/edit', compact('vendedoras', 'prenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prenda  $prenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prenda $prenda)
    {
        $data = request()->validate([
            'detalle'        => 'required|regex:/^[a-zA-Z\s]*$/',
            'color'   => 'required|regex:/^[a-zA-Z\s]*$/',
            'precio_original'   => 'required',
            'precio_venta'   => 'required',
            'genero'   => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        $prenda->update($data);
        return redirect(route('prendas.index'))->with('success', 'Prenda modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prenda  $prenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prenda $prenda)
    {
        if ($prenda->vendida === 0){
            $prenda->delete();
            return redirect(route('prendas.index'))->with('success', 'Prenda eliminada con éxito');
        }else{
            return redirect()->back()->with('error', 'No es posible eliminar una prenda vendida');
        }
    }

    public function consultarPrenda(Request $request)
    {
        $idPrendas = $request->get('idPrendas');
        $prendas = [];
        foreach ($idPrendas as $idPrenda){
            array_push($prendas, Prenda::where('id',$idPrenda)->first());
        }
        return $prendas;
    }
}
