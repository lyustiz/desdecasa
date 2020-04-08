<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user'       => 'required|max:255|unique:usuario,nb_usuario',
            'email'      => 'required|email|max:255|unique:usuario,tx_email',
            'password'   => 'required|min:8'
        ],
        [
            'user.unique' => 'El usuario ya está en uso.',
            'email.unique'      => 'El correo ya está en uso.',
        ]);    
    
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['co_confirmacion'] = Str::random(64);
        
        $usuario = Usuario::create([
            'nb_usuario'        => $data['user'],
            'tx_email'          => $data['email'],
            'password'          => Hash::make($data['password']),
            'id_status'         => 2,
            'id_usuario'        => 0,
            'co_confirmacion'   => $data['co_confirmacion']
        ]);

         // Enviar codigo de confirmacion
         \Mail::send('auth.mail.mail_confirm', $data, function($message) use ($data) {
            $message->to($data['email'], $data['user'])->subject('"DesdeCasaWeb.com", Por favor confirma tu correo');
        });

        /*$rolUsuario = RolUsuario::create([
            'id_rol'        => 1,
            'id_usuario'    => $usuario->id_usuario,
            'id_status'     => 1, 
        ]);*/


        return $usuario;
        
    }
}
