<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'fe_nacimiento'     => 'required',
            'tx_foto'           => 'required',
            'tx_sexo'           => 'required',
            'tx_src'            => 'required',
            'id_usuario'        => 'required',
            
        ]);
        
        $filename = $this->getFilename($request->input('tx_foto'), $usuario->id);
        
        $photo    = $this->storePhoto($request->input('tx_src'), $filename);

        $request->merge(['tx_foto' => $filename]);
  
        $usuario  = $usuario->update($request->except('tx_src'));

        return [ 'msj' => 'Usuario Actualizado' , compact('usuario')];
    }


    private function storePhoto($fileSrc, $filename)
	{
        $srcFoto  = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileSrc));

        $stored = Storage::disk('account')->put($filename, $srcFoto);

        return $stored;
    }
    
    
    private function getFilename($file, $id_usuario)
    {
        $extension = explode(".", $file)[1];

        return "$id_usuario.$extension"; 
    }

    public function updateEmail(Request $request, Usuario $usuario)
    {
        $validate = request()->validate([
            
            'tx_email'      => 'required',
            'tx_new_email'  => 'required',
            'tx_ret_email'  => 'required',
            'id_usuario'    => 'required',
        ]);


        $usuario  = $usuario->update([
            'tx_email'      => $request->input('tx_new_email'),
            'id_usuario'    => $request->input('id_usuario'),
        ]);

        return [ 'msj' => 'Correo Actualizado' , compact('usuario')];
    }

    public function updatePassword(Request $request, Usuario $usuario)
    {
        $validate = request()->validate([
            
            'tx_password'   => 'required',
            'tx_new_pass'   => 'required',
            'tx_ret_pass'   => 'required',
            'id_usuario'    => 'required',
        ]);

        if (\Hash::check($request->input('tx_new_pass'), $usuario->password)) {
            
            $usuario  = $usuario->update([
                'tx_password'   => $request->input('tx_password'),
                'id_usuario'    => $request->input('id_usuario'),
            ]);

            return [ 'msj' => 'Password Actualizado' , compact('usuario')];

        }else {

            return  response()->json(['errors' => ['password' => 'El Password Actual no coincide']], 422);
        }

    
        
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
