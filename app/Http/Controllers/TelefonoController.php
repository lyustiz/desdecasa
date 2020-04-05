<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $telefonos = Telefono::with(['status'])
                        ->get();
        
        return $telefonos;

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

            'tx_telefono'       => 'required',
            'id_comercio'       => 'required',
            'id_tipo_telefono'  => 'required',
            'bo_principal'      => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',
            
        ]);

        $telefono = Telefono::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('telefono') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function show(Telefono $telefono)
    {
        return $telefono;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Telefono $telefono)
    {
        $validate = request()->validate([

            'tx_telefono'       => 'required',
            'id_comercio'       => 'required',
            'id_tipo_telefono'  => 'required',
            'bo_principal'      => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required'
            
        ]);
        
        $telefono = $telefono->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('telefono')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telefono $telefono)
    {
        $telefono = $telefono->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('telefono')];

    }
}
