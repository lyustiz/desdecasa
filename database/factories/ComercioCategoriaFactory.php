<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ComercioCategoria;
use Faker\Generator as Faker;

$factory->define(ComercioCategoria::class, function (Faker $faker) {
    static $number = 1;
    return [
        'id_comercio'       => $number++,
        'id_categoria'      => $faker->numberBetween($min = 1, $max = 8),
        'id_status'         => 1,
        'id_usuario'        => 1,
    ];

});
