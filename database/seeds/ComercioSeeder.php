<?php

use Illuminate\Database\Seeder;

class ComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Comercio::class, 100)->create();

        //// php artisan db:seed --class=ComercioSeeder
    }
}
