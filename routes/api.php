<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'guest:api'], function () {

    Route::post('login',            'Auth\LoginController@login');
    Route::post('register',         'Auth\RegisterController@register');
    Route::post('password/email',   'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset',   'Auth\ResetPasswordController@reset');

    //email Verification
    Route::post('email/resend',     'Auth\VerificationController@resend');

    // Route::post('recaptcha',        'Auth\CaptchaController@checkToken');

//$this->middleware('verified');
/*
GET|HEAD  | email/verify                                 | verification.notice       | App\Http\Controllers\Auth\VerificationController@show                  | web,auth                     |
GET|HEAD  | email/verify/{id}/{hash}                     | verification.verify       | App\Http\Controllers\Auth\VerificationController@verify                | web,auth,signed,throttle:6,1 |
*/

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['prefix'=>'v1'], function() {

    Route::apiResource('/usuario',          'UsuarioController');
    Route::apiResource('/status',           'StatusController');
    Route::apiResource('/pais',             'PaisController', ['parameters' => ['pais' => 'pais']]);
    Route::apiResource('/departamento',     'DepartamentoController');
    Route::apiResource('/ciudad',           'CiudadController');
    Route::apiResource('/zona',             'ZonaController');
    Route::apiResource('/comuna',           'ComunaController');
    Route::apiResource('/barrio',           'BarrioController');
    Route::apiResource('/tipoServicio',     'TipoServicioController');
    Route::apiResource('/tipoFoto',         'TipoFotoController');
    Route::apiResource('/tipoPago',         'TipoPagoController');
    Route::apiResource('/tipoTelefono',     'TipoTelefonoController');
    Route::apiResource('/categoria',        'CategoriaController', ['parameters' => ['categoria' => 'categoria']]);
    Route::apiResource('/tipoComercio',     'TipoComercioController');
    Route::apiResource('/comercio',         'ComercioController');
    Route::apiResource('/comercioCategoria','ComercioCategoriaController', ['parameters' => ['comercioCategoria' => 'comercioCategoria']]);
    Route::apiResource('/telefono',         'TelefonoController');
    Route::apiResource('/horario',          'HorarioController');
    Route::apiResource('/contacto',         'ContactoController');
    Route::apiResource('/foto',             'FotoController');
    Route::apiResource('/pago',             'PagoController');
    Route::apiResource('/subcripcion',      'SubcripcionController');
    Route::apiResource('/valoracion',       'ValoracionController');

    Route::get('/barrio/zona/{id_zona}',             'BarrioController@barrioZona');

    Route::get('/comercio/categoria/{id_categoria}', 'ComercioController@comercioCategoria');
    Route::get('/comercio/barrio/{id_barrio}',       'ComercioController@comercioBarrio');
    Route::get('/comercio/filters/{filters}',        'ComercioController@comercioFilters');
    Route::get('/comercio/usuario/{id_usuario}',     'ComercioController@comercioUsuario');

    Route::post('/comercio/info',                   'ComercioController@comercioInfo');

    Route::put('/usuario/email/{usuario}',           'UsuarioController@updateEmail');
    Route::put('/usuario/password/{usuario}',        'UsuarioController@updatePassword');

    

});
