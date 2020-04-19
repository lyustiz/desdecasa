<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Comercio;
use Illuminate\Support\Facades\Crypt;


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

    //use RegistersUsers;

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
    protected function validator(Request $request)
    {
        return request()->validate([
            'nb_usuario' => 'required|max:255|unique:usuario,nb_usuario',
            'email'      => 'required|email|max:255|unique:usuario,tx_email',
            'password'   => 'required|min:8'
        ],
        [
            'nb_usuario.unique' => 'El usuario ya está en uso.',
            'email.unique'      => 'El correo ya está en uso.',
        ]);    
    
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $this->validator($request);
        
        $request->merge(['verification' => Str::random(64)]);
        
        $usuario = Usuario::create([
            'nb_usuario'        => $request->input('nb_usuario'),
            'tx_email'          => $request->input('email'),
            'password'          => Hash::make($request->input('password')),
            'id_tipo_usuario'   => 2,
            'id_status'         => 2,
            'id_usuario'        => 0,
            'verification'      => $request->input('verification')
        ]);

        $data =  $request->all();
        
        // string usuario | verificacion
        $data['verification'] = Crypt::encryptString($data['nb_usuario'] ) . '|' . $data['verification'];

        // Enviar codigo de confirmacion
        \Mail::send('auth.mail.mail_confirm', $data, function($message) use ($data) {
            $message->to($data['email'], $data['nb_usuario'])->subject('"DesdeCasaWeb.com", Por favor confirma tu correo');
        });

        return response('Created', 201);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCommerce(Request $request)
    {
        return request()->validate([
            'nb_comercio' => 'bail|required|max:100|unique:comercio,nb_comercio',
            'tx_nit'      => 'bail|required|max:12|unique:comercio,tx_nit',
            'nb_usuario'  => 'bail|required|max:255|unique:usuario,nb_usuario',
            'email'       => 'required|email|max:255|unique:usuario,tx_email',
            'password'    => 'required|min:8'
        ],
        [
            'nb_comercio.unique' => 'El nombre del Comercio ya esta en uso',
            'tx_nit.unique'      => 'El nit del Comercio ya esta en uso',
            'nb_usuario.unique'  => 'El usuario ya está en uso.',
            'email.unique'       => 'El correo ya está en uso.',
        ]);
    }

    public function registerCommerce(Request $request)
    {
        $this->validatorCommerce($request);

        $request->merge(['verification' => Str::random(64)]);

        $data = $request->all();  

        $result = \DB::transaction(function ()  use($request) {
            
            $usuario = Usuario::create([
                'nb_usuario'        => $request->input('nb_usuario'),
                'tx_email'          => $request->input('email'),
                'password'          => Hash::make($request->input('password')),
                'id_tipo_usuario'   => 3,
                'id_status'         => 2,
                'id_usuario'        => 0,
                'verification'      => $request->input('verification')
            ]);

            $comercio = Comercio::create(
                [
                    'nb_comercio'  => $request->input('nb_comercio'),
                    'nb_fiscal'    => $request->input('nb_comercio'),
                    'tx_nit'       => $request->input('tx_nit'),
                    'id_status'    => 1,
                    'id_usuario'   => $usuario->id,
                ]
            );

            return ['comercio' => $comercio, 'usuario' => $usuario];
        });
        
        // string usuario | verificacion
        $data['verification'] = Crypt::encryptString($data['nb_usuario'] ) . '|' . $data['verification'];

        // Enviar codigo de confirmacion
        \Mail::send('auth.mail.mail_confirm', $data, function($message) use ($data) {
            $message->to($data['email'], $data['nb_usuario'])->subject('"DesdeCasaWeb.com", Por favor confirma tu correo');
        });

        return response('Created', 201);
    }

    
}
