<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valoraciones = Valoracion::with(['status'])
                                  ->get();
        
        return $valoraciones;

    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valoracionComercio($id_comercio, $id_usuario)
    {
        $valoracionComercio =   Valoracion::select( 
                                   'valoracion.id', 
                                   'valoracion.id_comercio',
                                   'valoracion.tx_valoracion',
                                   'valoracion.nu_valoracion',
                                   'valoracion.created_at',
                                   'valoracion.updated_at',
                                   'usuario.nb_usuario'
                                )
                                ->join('usuario', 'valoracion.id_usuario', '=', 'usuario.id')
                                ->where('valoracion.id_comercio', $id_comercio)
                                ->where('valoracion.id_usuario','<>', $id_usuario)
                                ->latest('valoracion.updated_at')
                                ->take(10)
                                ->get();
        
        $valoracionUsuario =   Valoracion::select( 
                                    'valoracion.id', 
                                    'valoracion.id_comercio',
                                    'valoracion.tx_valoracion',
                                    'valoracion.nu_valoracion',
                                    'valoracion.created_at',
                                    'valoracion.updated_at',
                                )
                                ->where('valoracion.id_comercio', $id_comercio)
                                ->where('valoracion.id_usuario', $id_usuario)
                                ->first();

        return  [
                    'valoracionComercio' => $valoracionComercio, 
                    'valoracionUsuario'  => $valoracionUsuario
                ];
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
            'tx_valoracion'    => 'required|max:200',
            'nu_valoracion'    => 'required',
            'id_usuario'       => 'required',

        ]);

        $request->merge(['id_status' => 1]);

        $valoracion = Valoracion::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('valoracion') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function show(Valoracion $valoracion)
    {
        return $valoracion;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Valoracion $valoracion)
    {
        $validate = request()->validate([

            'id_comercio'      => 'required',
            'tx_valoracion'    => 'required|max:200',
            'nu_valoracion'    => 'required',
            'id_usuario'       => 'required',

        ]);
        
        $valoracion = $valoracion->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('valoracion')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Valoracion $valoracion)
    {
        $valoracion = $valoracion->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('valoracion')];

    }
}
