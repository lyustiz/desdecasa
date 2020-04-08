<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comercios = Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio:id,nb_barrio'])
                              ->select('id', 'nb_comercio', 'tx_descripcion', 'id_zona', 'tx_direccion' )
                              ->where('id_status', 1)
                              ->get();
        
        return $comercios;

    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioCategoria($id_categoria)
    {
        $barrios =  Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio'])
                    ->select('id', 'nb_comercio', 'tx_descripcion', 'id_zona', 'tx_direccion' )
                    ->whereHas('comercioCategoria', function (Builder $query) use ( $id_categoria ){
                        $query->where('id_categoria', $id_categoria);
                    })
                    ->where('id_status', 1)
                    ->get();
        
        return $barrios;
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioBarrio($id_barrio)
    {
        $barrios =  Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio:id,nb_barrio'])
                    ->select('id', 'nb_comercio', 'tx_descripcion', 'id_zona', 'tx_direccion' )
                    ->where('id_barrio', $id_barrio)
                    ->where('id_status', 1)
                    ->get();
        
        return $barrios;
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioFilters( array $filters)
    {
        $barrios =  Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio:id,nb_barrio'])
                    ->select('id', 'nb_comercio', 'tx_descripcion', 'id_zona', 'tx_direccion' )
                    ->where('id_barrio', $id_barrio)
                    ->where('id_status', 1)
                    ->get();
        
        return $barrios;
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioUsuario($id_usuario)
    {
        $barrios =  Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio:id,nb_barrio', 'horario:id,nb_horario'])
                    ->where('id_usuario', $id_usuario)
                    ->where('id_status', 1)
                    ->first();

        return $barrios;
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

            'nb_comercio'       => 'required',
            'nb_fiscal'        => 'required',
            'tx_nit'           => 'required',
            'tx_descripcion'   => 'required',
            'id_departamento'  => 'required',
            'id_ciudad'        => 'required',
            'id_zona'          => 'required',
            'id_comuna'        => 'required',
            'id_barrio'        => 'required',
            'tx_direccion'     => 'required',
            'id_tipo_comercio' => 'required',
            'id_tipo_pago'     => 'required',
            'nu_latitud'       => 'required',
            'nu_longitud'      => 'required',
            'tx_observaciones' => 'required',
            'id_status'        => 'required',
            'id_usuario'       => 'required',
            
        ]);

        $comercio = Comercio::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('comercio') ];
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comercioInfo(Request $request)
    {
        $validate = request()->validate([

            'nb_comercio'      => 'required',
            'nb_fiscal'        => 'required',
            'tx_nit'           => 'required',
            'tx_descripcion'   => 'required',
            'id_tipo_comercio' => 'required',
            'id_tipo_pago'     => 'required',
            'id_usuario'       => 'required',
            
        ]);

        $comercio = Comercio::create($request->all());

        return [ 'msj' => 'Informacion de Comercio actualizada', compact('comercio') ];
    
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function show(Comercio $comercio)
    {
        return $comercio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comercio $comercio)
    {
        $validate = request()->validate([

            'nb_comercio'       => 'required',
            'nb_fiscal'        => 'required',
            'tx_nit'           => 'required',
            'tx_descripcion'   => 'required',
            'id_departamento'  => 'required',
            'id_ciudad'        => 'required',
            'id_zona'          => 'required',
            'id_comuna'        => 'required',
            'id_barrio'        => 'required',
            'tx_direccion'     => 'required',
            'id_tipo_comercio' => 'required',
            'id_tipo_pago'     => 'required',
            'nu_latitud'       => 'required',
            'nu_longitud'      => 'required',
            'tx_observaciones' => 'required',
            'id_status'        => 'required',
            'id_usuario'       => 'required',

        ]);
        
        $comercio = $comercio->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('comercio')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comercio $comercio)
    {
        $comercio = $comercio->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('comercio')];

    }
}
