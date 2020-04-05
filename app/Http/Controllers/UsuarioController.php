<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::with(['status'])
                           ->get();
        
        return $usuarios;

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

            'nb_nombres'        => 'required',
            'nb_apellidos'      => 'required',
            'nb_usuario'        => 'required',
            'password'          => 'required',
            'tx_email'          => 'required',
            'tx_nuip'           => 'required',
            'tx_observaciones'  => 'required',
            'remember_token'    => 'required',
            'id_status'         => 'required',
            'id_usuarioe'       => 'required',
            
        ]);

        $usuario = Usuario::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('usuario') ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $usuario;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validate = request()->validate([

            'nb_nombres'        => 'required',
            'nb_apellidos'      => 'required',
            'nb_usuario'        => 'required',
            'password'          => 'required',
            'tx_email'          => 'required',
            'tx_nuip'           => 'required',
            'tx_observaciones'  => 'required',
            'remember_token'    => 'required',
            'id_status'         => 'required',
            'id_usuarioe'       => 'required',
            
        ]);
        
        $usuario = $usuario->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('usuario')];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario = $usuario->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('usuario')];

    }



    public function verify( $hash)
    {
        $usuario = Usuario::where('verification', $hash)->first();

        $mensaje = null;
        $tipo    = null;

        if ($usuario)
        {
            $usuario->id_status     = 1;
            $usuario->verification  = null;
            $usuario->save();

            $mensaje = 'Correo del Usuario Confirmado ';
            $tipo    = 'success';
            $resend  = true;
        }
        else
        {
            $mensaje = 'Código de confirmacion inválido';
            $tipo    = 'error';
            $resend  = false;
        }

        return view('auth.confirm', compact('mensaje', 'tipo', 'resend'));

    }
}
