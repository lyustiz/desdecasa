<?php

use Illuminate\Database\Seeder;

class ComercioCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ComercioCategoria::class, 100)->create();

        //// php artisan db:seed --class=ComercioCategoriaSeeder
    }
}
