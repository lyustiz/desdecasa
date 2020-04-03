<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = Contacto::with(['status'])
                             ->get();
        
        return $contactos;

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
            
            'id_comercio'       => 'required',
            'tx_comercio'       => 'required',
            'tx_sitio_web'      => 'required',
            'tx_facebook'       => 'required',
            'tx_twitter'        => 'required',
            'tx_instagram'      => 'required',
            'tx_youtube'        => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',
            
        ]);

        $contacto = Contacto::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('contacto') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        return $contacto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        $validate = request()->validate([

            'id_comercio'       => 'required',
            'tx_comercio'       => 'required',
            'tx_sitio_web'      => 'required',
            'tx_facebook'       => 'required',
            'tx_twitter'        => 'required',
            'tx_instagram'      => 'required',
            'tx_youtube'        => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',

        ]);
        
        $contacto = $contacto->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('contacto')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $contacto = $contacto->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('contacto')];

    }
}
