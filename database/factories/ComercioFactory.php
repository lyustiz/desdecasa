<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comercio;
use Faker\Generator as Faker;

//$faker = Faker\Factory::create('es_VE'); 

$factory->define(Comercio::class, function (Faker $faker) {
    $company = $faker->Company;
    return [
        'nb_comercio'      => $company,
        'nb_fiscal'        => $company,
        'tx_nit'           => $faker->bothify('########-#'),
        'tx_descripcion'   => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'id_departamento'  => 76,
        'id_ciudad'        => 1006,
        'id_zona'          => $faker->numberBetween($min = 1, $max = 6),
        'id_comuna'        => $faker->numberBetween($min = 1, $max = 22),
        'id_barrio'        => $faker->numberBetween($min = 1, $max = 390),
        'tx_direccion'     => $faker->streetAddress(),
        'id_tipo_comercio' => $faker->numberBetween($min = 1, $max = 3),
        'id_tipo_pago'     => $faker->numberBetween($min = 1, $max = 6),
        'nu_latitud'       => $faker->latitude($min = 3.488, $max = 3.489),    
        'nu_longitud'      => $faker->longitude($min = -76.488, $max = -76.489),
        'id_status'        => 1,
        'id_usuario'       => 1,
    ];
});


            