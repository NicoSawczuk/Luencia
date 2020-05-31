<?php

namespace App\Http\Controllers;

use App\Vendedora;
use Illuminate\Http\Request;

class VendedoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedoras = Vendedora::all();
        
        return view('vendedoras/index', compact('vendedoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendedoras.create');
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
            'nombre'        => 'required|regex:/^[a-zA-Z\s]*$/',
            'apellido'   => 'required|regex:/^[a-zA-Z\s]*$/'
        ]);

        $vendedora = new Vendedora();
        $vendedora->nombre = $request->nombre;
        $vendedora->apellido = $request->apellido;

        $vendedora->save();

        if ($vendedora->save()) {
            return redirect(route('vendedoras.index'))->with('success', 'Vendedora creada con éxito');
        }
        return redirect()->back()->withErrors('No se pudo crear la vendedora');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedora $vendedora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedora $vendedora)
    {
        return view('vendedoras/edit', compact('vendedora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedora $vendedora)
    {
        $data = request()->validate([
            'nombre'        => 'required|regex:/^[a-zA-Z\s]*$/',
            'apellido'   => 'required|regex:/^[a-zA-Z\s]*$/'
        ]);

        $vendedora->update($data);

        return redirect(route('vendedoras.index'))->with('success', 'Vendedora modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedora $vendedora)
    {
        if ($vendedora->prendas->count() > 0){
            return redirect(route('vendedoras.index'))->with('error', 'La vendedora no se puede eliminar porque tiene prendas asociadas');
        }else{
            $vendedora->delete();
            return redirect(route('vendedoras.index'))->with('success', 'Vendedora eliminada con éxito');
        }
    }
}
