<?php

namespace App\Http\Controllers;

use App\Models\TipoComercio;
use Illuminate\Http\Request;

class TipoComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoComercios = TipoComercio::with(['status'])
                                     ->get();
        
        return $tipoComercios;

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

            'nb_tipo_comercio'  => 'required',
            'tx_icono'          => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',
            
        ]);

        $tipoComercio = TipoComercio::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('tipoComercio') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoComercio  $tipoComercio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoComercio $tipoComercio)
    {
        return $tipoComercio;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoComercio  $tipoComercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoComercio $tipoComercio)
    {
        $validate = request()->validate([

            'nb_tipo_comercio'  => 'required',
            'tx_icono'          => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',
            
        ]);
        
        $tipoComercio = $tipoComercio->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('tipoComercio')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoComercio  $tipoComercio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoComercio $tipoComercio)
    {
        $tipoComercio = $tipoComercio->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('tipoComercio')];

    }
}
