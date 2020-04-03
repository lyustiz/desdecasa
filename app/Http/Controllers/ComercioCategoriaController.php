<?php

namespace App\Http\Controllers;

use App\Models\ComercioCategoria;
use Illuminate\Http\Request;

class ComercioCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comercioCategorias = Comercio_Categoria::with(['status'])
                        ->get();
        
        return $comercioCategorias;

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
            'id_categoria'      => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',

        ]);

        $comercioCategoria = Comercio_Categoria::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('comercioCategoria') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComercioCategoria  $comercioCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(ComercioCategoria $comercioCategoria)
    {
        return $comercioCategoria;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComercioCategoria  $comercioCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComercioCategoria $comercioCategoria)
    {
        $validate = request()->validate([

            'id_comercio'       => 'required',
            'id_categoria'      => 'required',
            'tx_observaciones'  => 'required',
            'id_status'         => 'required',
            'id_usuario'        => 'required',

        ]);
        
        $comercioCategoria = $comercioCategoria->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('comercioCategoria')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComercioCategoria  $comercioCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComercioCategoria $comercioCategoria)
    {
        $comercioCategoria = $comercio_categoria->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('comercioCategoria')];

    }
}
