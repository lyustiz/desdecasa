<?php

namespace App\Http\Controllers;

use App\Models\ComercioDespacho;
use Illuminate\Http\Request;

class ComercioDespachoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comercioDespachos = ComercioDespacho::with(['status'])
                            ->get();
        
        return $comercioDespachos;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'id_comercio'      => 'required',
            'id_zona'          => 'required',
            'id_status'        => 'required',
            'id_usuario'       => 'required',
        ]);
    
        $comercioDespacho = ComercioDespacho::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('comercioDespacho') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComercioDespacho  $comercioDespacho
     * @return \Illuminate\Http\Response
     */
    public function show(ComercioDespacho $comercioDespacho)
    {
        return $comercioDespacho;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComercioDespacho  $comercioDespacho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComercioDespacho $comercioDespacho)
    {
        $validate = request()->validate([
            'id_comercio'      => 'required',
            'id_zona'          => 'required',
            'id_status'        => 'required',
            'id_usuario'       => 'required',
        ]);
        
        $comercioDespacho = $comercio_despacho->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('comercioDespacho')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComercioDespacho  $comercioDespacho
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComercioDespacho $comercioDespacho)
    {
        $comercioDespacho = $comercio_despacho->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('comercioDespacho')];

    }
}
